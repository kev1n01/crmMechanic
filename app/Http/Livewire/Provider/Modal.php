<?php

namespace App\Http\Livewire\Provider;

use App\Http\Requests\RequestProvider;
use App\Models\Provider;
use Illuminate\Support\Facades\Http;
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
        return (new RequestProvider)->rules($this->editing);
    }

    public function messages()
    {
        return (new RequestProvider)->messages();
    }

    public function save()
    {
        $this->validate();
        $this->editing->save();
        $this->nameModal === 'Crear nuevo proveedor' ? $this->emit('success_alert', 'Proveedor creado') : $this->emit('success_alert', 'Proveedor actualizado');
        $this->dispatchBrowserEvent('close-modal-provider');
        $this->emit('refreshList');
        $this->emit('refreshListModals');
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
        $this->validateOnly($label, $this->rules(), $this->messages());
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
