<?php

namespace App\Http\Livewire\Vehicle;

use App\Helpers\Csv;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;

class Import extends Component
{
    use WithFileUploads;
    public $upload, $columns;
    public $fieldColumnMap = [
        'license_plate' => '',
        'model_year' => '',
        'odo' => '',
        'description' => '',
    ];

    protected $rules = [
        'fieldColumnMap.license_plate' => 'required',
        'fieldColumnMap.model_year' => 'required',
        'fieldColumnMap.odo' => 'required',
        'fieldColumnMap.description' => 'required',
    ];

    protected $messages = [
        'fieldColumnMap.license_plate.required' => 'El campo placa es obligatorio',
        'fieldColumnMap.model_year.required' => 'El campo año es obligatorio',
        'fieldColumnMap.odo.required' => 'El campo odo es obligatorio',
        'fieldColumnMap.description.required' => 'El campo descripcion es obligatorio',
    ];

    protected $customAttributes = [
        'fieldColumnMap.license_plate' => 'placa',
        'fieldColumnMap.model_year' => 'año',
        'fieldColumnMap.odo' => 'odo',
        'fieldColumnMap.description' => 'descripcion',
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
            'license_plate' => '',
            'model_year' => '',
            'odo' => '',
            'description' => '',
        ];
    }

    public function exportTemplate()
    {
        return response()->download(public_path() . "/exports/template_vehicles_import.csv");
    }

    public function import()
    {
        $this->validate();
        try {
            $importCount = 0;
            Csv::from($this->upload)
                ->eachRow(function ($row) use (&$importCount) {
                    Vehicle::create(
                        $this->extractFieldsFromRow($row)
                    );

                    $importCount++;
                });
            $this->emit('refreshList');
            $this->emit('reset_page', '');
            $this->upload = null;
            $this->emit('success_alert', $importCount . 'vehiculos fueron importados');
        } catch (\Exception $e) {
            $this->emit(
                'error_alert',
                $e->getMessage()
                // 'Error al importar vehiculos, por favor verifique lo siguiente:&nbsp;
                //                                 - que el campo placa no estén repetidos o existan ya en la base de datos&nbsp;
                //                                 '
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
            'license_plate' => ['license_plate', 'license_plate'],
            'model_year' => ['model_year', 'model_year'],
            'odo' => ['odo', 'odo'],
            'description' => ['description', 'description'],
        ];

        foreach ($this->columns as $column) {
            $match = collect($guesses)->search(fn ($options) =>
            in_array(strtolower($column), $options));

            if ($match) $this->fieldColumnMap[$match] = $column;
        }
    }

    public function render()
    {
        return view('livewire.vehicle.import');
    }
}
