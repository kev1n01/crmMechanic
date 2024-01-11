<?php

namespace App\Http\Livewire\Product;

use App\Helpers\Csv;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;

class Import extends Component
{
    use WithFileUploads;
    public $upload, $columns;
    public $fieldColumnMap = [
        'name' => '',
        'code' => '',
        'sku' => '',
        'stock' => '',
        'sale_price' => '',
        'purchase_price' => '',
        'status' => '',
    ];

    protected $rules = [
        'fieldColumnMap.name' => 'required',
        'fieldColumnMap.code' => 'required',
        'fieldColumnMap.sku' => 'required',
        'fieldColumnMap.stock' => 'required',
        'fieldColumnMap.sale_price' => 'required',
        'fieldColumnMap.purchase_price' => 'required',
        'fieldColumnMap.status' => 'required',
    ];

    protected $messages = [
        'fieldColumnMap.name.required' => 'El campo nombre es obligatorio',
        'fieldColumnMap.code.required' => 'El campo codigo es obligatorio',
        'fieldColumnMap.sku.required' => 'El campo sku es obligatorio',
        'fieldColumnMap.stock.required' => 'El campo stock es obligatorio',
        'fieldColumnMap.sale_price.required' => 'El campo precio venta es obligatorio',
        'fieldColumnMap.purchase_price.required' => 'El campo precio compra es obligatorio',
        'fieldColumnMap.status.required' => 'El campo estado es obligatorio',
    ];

    protected $customAttributes = [
        'fieldColumnMap.name' => 'nombre',
        'fieldColumnMap.code' => 'codigo',
        'fieldColumnMap.sku' => 'sku',
        'fieldColumnMap.stock' => 'stock',
        'fieldColumnMap.sale_price' => 'precio venta',
        'fieldColumnMap.purchase_price' => 'precio compra',
        'fieldColumnMap.status' => 'estado',
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
            'code' => '',
            'sku' => '',
            'stock' => '',
            'sale_price' => '',
            'purchase_price' => '',
            'status' => '',
        ];
    }

    public function exportTemplate()
    {
        return response()->download(public_path() . "/exports/template_products_import.csv");
    }

    public function import()
    {
        $this->validate();
        try {
            $importCount = 0;
            Csv::from($this->upload)
                ->eachRow(function ($row) use (&$importCount) {
                    Product::create(
                        $this->extractFieldsFromRow($row)
                    );

                    $importCount++;
                });
            $this->emit('refreshList');
            $this->emit('reset_page', '');
            $this->upload = null;
            $this->emit('success_alert', $importCount . 'productos fueron importados');
        } catch (\Exception $e) {
            $this->emit(
                'error_alert',
                // $e->getMessage()
                'Error al importar productos, por favor verifique lo siguiente:&nbsp;
                                                - que el campo nombre no estén repetidos o existan ya en la base de datos&nbsp;
                                                - que el campo stock sea un numero entero&nbsp;
                                                - que el campo precio compra y venta sean numeros&nbsp; 
                                                '
            );
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
            'code' => ['code', 'code'],
            'sku' => ['sku', 'sku'],
            'stock' => ['stock', 'stock'],
            'sale_price' => ['sale_price', 'sale_price'],
            'purchase_price' => ['purchase_price', 'purchase_price'],
            'status' => ['status', 'status'],
        ];

        foreach ($this->columns as $column) {
            $match = collect($guesses)->search(fn ($options) =>
            in_array(strtolower($column), $options));

            if ($match) $this->fieldColumnMap[$match] = $column;
        }
    }

    public function render()
    {
        return view('livewire.product.import');
    }
}
