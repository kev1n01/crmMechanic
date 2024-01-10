<?php

namespace App\Http\Livewire\Customer;

use App\Http\Requests\RequestCustomer;
use App\Models\Customer;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Modal extends Component
{
    public $idModal = 'customerModal';
    public $nameModal;
    public $type_documents = [];
    public $type_doc;
    public $statuses = [];
    public Customer $editing;
    protected $listeners = ['createcustomer' => 'create', 'editcustomer' => 'edit'];

    public function rules()
    {
        return (new RequestCustomer())->rules($this->editing);
    }

    function messages()
    {
        return (new RequestCustomer())->messages();
    }

    public function mount()
    {
        $this->editing = $this->makeBlankFields();
        $this->statuses = Customer::STATUSES;
        $this->type_documents = Customer::TYPE_DOCUMENTS;
    }

    public function save()
    {
        $this->validate();
        $this->editing->save();
        $this->nameModal === 'Crear nuevo cliente' ? $this->emit('success_alert', 'Cliente creado') : $this->emit('success_alert', 'Cliente actualizado');
        $this->dispatchBrowserEvent('close-modal-customer');
        $this->emit('refreshList');
        $this->emit('refreshListModals');
    }

    public function searchNumDoc()
    {
        if (!$this->type_doc) {
            $this->emit('info_alert', 'Seleccione un tipo de documento primero');
            return;
        }
        if (!$this->editing->num_doc) {
            $this->emit('info_alert', 'Ingrese un numero de documento primero');
            return;
        }
        $this->type_doc == '1' ? $this->searchDni() : $this->searchRuc();
    }

    public function searchDni()
    {
        if (strlen($this->editing->num_doc) != 8) {
            $this->emit('info_alert', 'El numero de documento debe tener 8 digitos');
            return;
        }
        $response = Http::get('https://dniruc.apisperu.com/api/v1/dni/' . $this->editing->num_doc . '?token=' . env('APIPERU_TOKEN_DOC'));
        $data = $response->collect();
        if ($data['success']) {
            $this->editing->name = $data['nombres'] . ' ' . $data['apellidoPaterno'] . ' ' . $data['apellidoMaterno'];
        } else {
            $this->emit('error_alert', 'El numero de documento ingresado es invalido');
        }
    }

    public function searchRuc()
    {
        if (strlen($this->editing->num_doc) != 11) {
            $this->emit('info_alert', 'El numero de documento debe tener 11 digitos');
            return;
        }
        $response = Http::get('https://dniruc.apisperu.com/api/v1/ruc/' . $this->editing->num_doc . '?token=' . env('APIPERU_TOKEN_DOC'));
        $data = $response->collect();
        if ($data->count() != 2) {
            $this->editing->name = $data['razonSocial'];
            $this->editing->address = $data['direccion'];
        } else {
            $this->emit('error_alert', 'El numero de documento ingresado es invalido');
            $this->editing->name = '';
            $this->editing->address = '';
        }
    }

    public function updated($label)
    {
        $this->validateOnly($label, $this->rules(), $this->messages());
    }

    public function makeBlankFields()
    {
        return Customer::make(['status' => 'activo']); /*para dejar vacios los inpust*/
    }

    public function create()
    {
        if ($this->editing->getKey()) $this->editing = $this->makeBlankFields(); // para preservar cambios en los inputs
        $this->nameModal = 'Crear nuevo cliente';
        $this->resetErrorBag();
        $this->resetValidation();
        $this->dispatchBrowserEvent('open-modal-customer');
    }

    public function edit(Customer $customer)
    {
        $this->nameModal = 'Editar cliente';
        $this->resetErrorBag();
        $this->resetValidation();
        $this->dispatchBrowserEvent('open-modal-customer');
        if ($this->editing->isNot($customer)) $this->editing = $customer; // para preservar cambios en los inputs
        strlen($this->editing->type_doc) == '1' ? $this->type_doc = '1' : $this->type_doc = '6';
    }

    public function closeModal()
    {
        $this->dispatchBrowserEvent('close-modal-customer');
    }

    public function render()
    {
        return view('livewire.customer.modal');
    }
}
