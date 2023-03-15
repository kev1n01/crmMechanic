<?php

namespace App\Http\Livewire\Brand;

use App\Helpers\Csv;
use App\Models\BrandProduct;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
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
        'fieldColumnMap.name.required' => 'El campo nombre es obligatorio',
    ];

    protected $customAttributes = [
        'fieldColumnMap.name' => 'nombre',
    ];

    public function updatingUpload($value)
    {
        Validator::make(
            ['upload' => $value],
            ['upload' => 'required|mimes:csv'],
            ['upload.mimes' => 'Solo se permite archivo tipo .csv']
        );
    }

    public function updatedUpload()
    {
        $this->columns = Csv::from($this->upload)->columns();

        $this->guessWhichColumnsMapToWhichFields();
    }

    public function cancel()
    {
        $this->upload = null;
        $this->columns = null;
        $this->fieldColumnMap = [
            'name' => '',
        ];
    }
    
    public function import()
    {
        $this->validate();
        try {
            $importCount = 0;
            Csv::from($this->upload)
                ->eachRow(function ($row) use (&$importCount) {
                    BrandProduct::create(
                        $this->extractFieldsFromRow($row)
                    );

                    $importCount++;
                });
            $this->emit('refreshList');
            $this->upload = null;
            $this->emit('success_alert', $importCount . 'marcas fueron importados');
        } catch (\Exception $e) {
            $this->emit('error_alert', 'Error al importar marcas, por favor verifique lo siguiente:&nbsp;
                                            - que el nombre de las marcas no estén repetidos&nbsp;
                                            - que el nombre de las marcas tengan como minimo 3 caracteres&nbsp;
                                            - que el nombre de las marcas tengan como maximo 30 caracteres&nbsp;
                                            - que el nombre de las marcas no este vacias
                                            ');
        }
    }

    public function extractFieldsFromRow($row)
    {
        $attributes = collect($this->fieldColumnMap)
            ->filter()
            ->mapWithKeys(function ($heading, $field) use ($row) {
                return [$field => $row[$heading]];
            })->toArray();

        return $attributes;
    }

    public function guessWhichColumnsMapToWhichFields()
    {
        $guesses = [
            'name' => ['name', 'name'],
        ];

        foreach ($this->columns as $column) {
            $match = collect($guesses)->search(fn ($options) =>
            in_array(strtolower($column), $options));

            if ($match) $this->fieldColumnMap[$match] = $column;
        }
    }

    public function render()
    {
        return view('livewire.brand.import');
    }
}
