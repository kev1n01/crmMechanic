<?php

namespace App\Http\Livewire\DuePay;

use App\Helpers\Csv;
use App\Models\DuePay;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Validator;

class Import extends Component
{
    use WithFileUploads;
    public $upload, $columns;
    public $fieldColumnMap = [
        'description' => '',
        'person_owed' => '',
        'amount_owed' => '',
        'amount_paid' => '',
        'reason' => '',
    ];

    protected $rules = [
        'fieldColumnMap.description' => 'required',
        'fieldColumnMap.person_owed' => 'required',
        'fieldColumnMap.amount_owed' => 'required',
        'fieldColumnMap.amount_paid' => 'required',
        'fieldColumnMap.reason' => 'required',
    ];

    protected $messages = [
        'fieldColumnMap.description.required' => 'El campo nombre es obligatorio',
        'fieldColumnMap.person_owed.required' => 'El campo nombre es obligatorio',
        'fieldColumnMap.amount_owed.required' => 'El campo nombre es obligatorio',
        'fieldColumnMap.amount_paid.required' => 'El campo nombre es obligatorio',
        'fieldColumnMap.reason.required' => 'El campo nombre es obligatorio',
    ];

    protected $customAttributes = [
        'fieldColumnMap.description' => 'descripcion',
        'fieldColumnMap.person_owed' => 'persona adeudada',
        'fieldColumnMap.amount_owed' => 'monto adeudado',
        'fieldColumnMap.amount_paid' => 'monto pagado',
        'fieldColumnMap.reason' => 'razon',
    ];

    public function updatingUpload($value)
    {
        Validator::make(
            ['upload' => $value],
            ['upload' => 'required|mimes:csv'],
            ['upload.mimes' => 'Solo se permite archivo tipo .csv']
        )->validate();
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
            'description' => '',
            'person_owed' => '',
            'amount_owed' => '',
            'amount_paid' => '',
            'reason' => '',
        ];
    }

    public function import()
    {
        $this->validate();
        try {
            $importCount = 0;
            Csv::from($this->upload)
                ->eachRow(function ($row) use (&$importCount) {
                    DuePay::create(
                        $this->extractFieldsFromRow($row)
                    );

                    $importCount++;
                });
            $this->emit('refreshList');
            $this->upload = null;
            $this->emit('success_alert', $importCount . 'deudas fueron importados');
        } catch (\Exception $e) {
            $this->emit('error_alert', 'Error al importar deudas, por favor verifique lo siguiente:&nbsp;
                                            - que algun campo de las deudas no estén repetidos&nbsp;
                                            - que algun campo de las deudas tengan como los caracteres correctos&nbsp;
                                            - que algun campo de las deudas no este vacias
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
            'description' => ['description', 'description'],
            'person_owed' => ['person_owed', 'person_owed'],
            'amount_owed' => ['amount_owed', 'amount_owed'],
            'amount_paid' => ['amount_paid', 'amount_paid'],
            'reason' => ['reason', 'reason'],
        ];

        foreach ($this->columns as $column) {
            $match = collect($guesses)->search(fn ($options) =>
            in_array(strtolower($column), $options));

            if ($match) $this->fieldColumnMap[$match] = $column;
        }
    }

    public function render()
    {
        return view('livewire.due-pay.import');
    }
}
