<?php

namespace App\Http\Livewire\Category;

use App\Helpers\Csv;
use App\Models\CategoryProduct;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Livewire\WithFileUploads;

class Import extends Component
{
    use WithFileUploads;
    public $upload, $columns;
    public $fieldColumnMap = [
        'name' => '',
    ];

    protected $rules = [
        'fieldColumnMap.name' => 'required',
    ];
    
    protected $messages = [
        'fieldColumnMap.name.required' => 'EL campo nombre es requerido',
    ];
    
    protected $customAttributes = [
        'fieldColumnMap.name' => 'nombre',
    ];
    
    public function updatingUpload($value){
        Validator::make(
            ['upload' => $value],
            ['upload' => 'required|mimes:csv'],
            ['upload.mimes' => 'Solo se permite archivo tipo .csv']
        )->validate();
    }
    
    public function updatedUpload(){
        $this->columns = Csv::from($this->upload)->columns();

        $this->guessWhichColumnsMapToWhichFields();
    }

    public function import(){
        $this->validate($this->rules,$this->messages);

        $importCount = 0;
        Csv::from($this->upload)
            ->eachRow(function ($row) use (&$importCount){
            CategoryProduct::create(
                $this->extractFieldsFromRow($row)    
            );

            $importCount++;

        });
        $this->emit('refreshList');
        $this->emit('success_alert', $importCount.'categorias fueron importados');
    }

    public function extractFieldsFromRow($row){
        $attributes = collect($this->fieldColumnMap)
        ->filter()
        ->mapWithKeys(function($heading, $field) use ($row){
            return [$field => $row[$heading]];
        })->toArray();

        return $attributes;
    }
 
    public function guessWhichColumnsMapToWhichFields(){
        $guesses = [
            'name' => ['name','name'],
        ];
 
        foreach ($this->columns as $column) {
            $match = collect($guesses)->search(fn($options) =>
             in_array(strtolower($column), $options));

             if($match) $this->fieldColumnMap[$match] = $column; 
        }
    }

    public function render()
    {
        return view('livewire.category.import');
    }
}
