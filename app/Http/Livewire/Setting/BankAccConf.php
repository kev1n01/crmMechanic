<?php

namespace App\Http\Livewire\Setting;

use App\Models\BankAcc;
use App\Traits\DataTable;
use Illuminate\Validation\Rule;
use Livewire\Component;

class BankAccConf extends Component
{
    use DataTable;
    public BankAcc $editing;
    protected $listeners = ['delete'];

    public function mount()
    {
        $this->editing = $this->makeBlankFields();
    }

    public function rules()
    {
        return [
            'editing.name' => ['required', Rule::unique('bank_accs', 'name')->ignore($this->editing)],
            'editing.cta_bank' => ['required', 'max:18', 'min:18', Rule::unique('bank_accs', 'cta_bank')->ignore($this->editing)],
            'editing.cta_interbank' => ['nullable', 'max:20', 'min:20', Rule::unique('bank_accs', 'cta_interbank')->ignore($this->editing)],

        ];
    }

    protected $messages = [
        'editing.name.required' => 'El nombre del banco es obligatorio',
        'editing.name.unique' => 'El nombre del banco ya esta registrado',
        'editing.cta_bank.required' => 'La cuenta bancaria es obligatorio',
        'editing.cta_bank.unique' => 'La cuenta bancaria ya esta registrada',
        'editing.cta_bank.max' => 'La cuenta bancaria no debe tener más de 18 caracteres',
        'editing.cta_bank.min' => 'La cuenta bancaria no debe tener menos de 18 caracteres',
        'editing.cta_interbank.unique' => 'La cuenta interbancaria ya esta registrada',
        'editing.cta_interbank.max' => 'La cuenta interbancaria no debe tener más de 20 caracteres',
        'editing.cta_interbank.min' => 'La cuenta interbancaria no debe tener menos de 20 caracteres',
    ];

    public function updated($label)
    {
        $this->validateOnly($label, $this->rules(), $this->messages);
    }

    public function save()
    {
        $this->validate();
        $this->editing->save();
        $this->editing = $this->makeBlankFields();
        $this->emit('success_alert', 'Configuración de cuentas de banco guardada con éxito');
    }

    public function delete(BankAcc $bankacc)
    {
        $bankacc->delete();
        $this->emit('success_alert', 'Cuenta de banco eliminada con éxito');
    }

    public function makeBlankFields()
    {
        return BankAcc::make(); /*para dejar vacios los inpust*/
    }

    public function edit(BankAcc $bankacc)
    {
        $this->editing = $bankacc;
    }

    public function render()
    {
        $banksacc = BankAcc::get();
        return view('livewire.setting.bank-acc-conf', [
            'banksacc' => $banksacc,
        ]);
    }
}
