<?php

namespace App\Http\Livewire\Provider;

use App\Models\Provider;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Modal extends Component
{
    public $idModal = 'providerModal';
    public $nameModal;
    public $statuses = [];
    public Provider $editing;
    protected $listeners = ['createprovider' => 'create', 'editprovider' => 'edit'];
    public function mount()
    {
        $this->editing = $this->makeBlankFields();
        $this->statuses = Provider::STATUSES;
    }

    public function rules()
    {
        return [
            'editing.name' => ['required', 'min:4', 'max:50', Rule::unique('providers', 'name')->ignore($this->editing)],
            'editing.phone' => ['required', 'min:9', 'max:9', Rule::unique('providers', 'phone')->ignore($this->editing)],
            'editing.address' => ['nullable', 'min:5', 'max:50', Rule::unique('providers', 'address')->ignore($this->editing)],
            'editing.ruc' => ['required', 'min:11', 'max:11', Rule::unique('providers', 'ruc')->ignore($this->editing)],
            'editing.status' => 'required|in:' . collect(Provider::STATUSES)->keys()->implode(','),
        ];
    }

    protected $messages = [
        'editing.name.required' => 'El nombre es obligatorio',
        'editing.name.min' => 'El nombre debe tener al menos 4 caracteres',
        'editing.name.max' => 'El nombre no debe tener más de 50 caracteres',
        'editing.name.unique' => 'Este nombre ya fue registrado',

        'editing.phone.required' => 'El celular es obligatorio',
        'editing.phone.min' => 'El celular debe tener al menos 9 caracteres',
        'editing.phone.max' => 'El celular no debe tener más de 9 caracteres',
        'editing.phone.unique' => 'El celular ya fue registrado',

        'editing.address.min' => 'La dirección debe tener al menos 5 caracteres',
        'editing.address.max' => 'La dirección no debe tener más de 50 caracteres',
        'editing.address.unique' => 'La dirección ya fue registrado',

        'editing.ruc.required' => 'El ruc es obligatorio',
        'editing.ruc.min' => 'El ruc debe tener al menos 11 caracteres',
        'editing.ruc.max' => 'El ruc no debe tener más de 11 caracteres',
        'editing.ruc.unique' => 'El ruc ya fue registrado',

        'editing.status.required' => 'El estado es obligatorio',
        'editing.status.in' => 'El valor es inválido',
    ];

    public function save()
    {
        $this->validate();
        $this->editing->save();
        $this->nameModal === 'Crear nuevo proveedor' ? $this->emit('success_alert', 'Proveedor creado') : $this->emit('success_alert', 'Proveedor actualizado');
        $this->dispatchBrowserEvent('close-modal-provider');
        $this->emit('refreshList');
    }

    public function searchRuc()
    {
        if (strlen($this->editing->ruc) != 11) {
            $this->emit('info_alert', 'Ingrese un RUC primero');
            return;
        } else {
            $response = Http::get('https://dniruc.apisperu.com/api/v1/ruc/' . $this->editing->ruc . '?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImNyYXp5YXJub2xkMDFAZ21haWwuY29tIn0.J8854s4Hy2oclyowM_lWgcGCRoHlXd5i1c6QXLrKORI');
            $data = $response->collect();
            if ($data->count() != 2) {
                $this->editing->name = $data['razonSocial'];
                $this->editing->address = $data['direccion'];
            } else {
                $this->editing->name = '';
                $this->editing->address = '';
                $this->emit('error_alert', 'El RUC no existe');
            }
        }
    }

    public function updated($label)
    {
        $this->validateOnly($label, $this->rules(), $this->messages);
    }

    public function makeBlankFields()
    {
        return Provider::make(['status' => 'activo']); /*para dejar vacios los inpust*/
    }

    public function create()
    {
        if ($this->editing->getKey()) $this->editing = $this->makeBlankFields(); // para preservar cambios en los inputs
        $this->nameModal = 'Crear nuevo proveedor';
        $this->resetErrorBag();
        $this->resetValidation();
        $this->dispatchBrowserEvent('open-modal-provider');
    }

    public function edit(Provider $provider)
    {
        $this->nameModal = 'Editar proveedor';
        $this->resetErrorBag();
        $this->resetValidation();
        $this->dispatchBrowserEvent('open-modal-provider');
        if ($this->editing->isNot($provider)) $this->editing = $provider; // para preservar cambios en los inputs
        $this->emit('refreshList');
    }

    public function closeModal()
    {
        $this->dispatchBrowserEvent('close-modal-provider');
    }

    public function render()
    {
        return view('livewire.provider.modal');
    }
}
