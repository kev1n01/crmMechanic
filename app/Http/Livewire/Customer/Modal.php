<?php

namespace App\Http\Livewire\Customer;

use App\Models\Customer;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Modal extends Component
{
    public $idModal = 'customerModal';
    public $nameModal;
    public $showInputs = false;
    public $statuses = [];
    public Customer $editing;
    protected $listeners = ['createcustomer' => 'create', 'editcustomer' => 'edit'];

    public function rules()
    {
        return [
            'editing.name' => ['required', 'min:3', 'max:100', Rule::unique('customers', 'name')->ignore($this->editing)],
            'editing.dni' => ['nullable', 'min:8', 'max:8', Rule::unique('customers', 'dni')->ignore($this->editing)],
            'editing.ruc' => ['nullable', 'min:11', 'max:11', Rule::unique('customers', 'ruc')->ignore($this->editing)],
            'editing.address' => ['nullable', 'min:5', 'max:100', Rule::unique('customers', 'address')->ignore($this->editing)],
            'editing.phone' => ['required', 'min:9', 'max:9', Rule::unique('customers', 'phone')->ignore($this->editing)],
            'editing.email' => ['nullable', 'email', Rule::unique('customers', 'email')->ignore($this->editing)],
            'editing.status' => 'required|in:' . collect(Customer::STATUSES)->keys()->implode(','),
        ];
    }

    protected $messages = [
        'editing.name.required' => 'El nombre es obligatorio',
        'editing.name.min' => 'El nombre debe tener al menos 3 caracteres',
        'editing.name.max' => 'El nombre no debe tener más de 100 caracteres',
        'editing.name.unique' => 'Este nombre ya fue registrado',

        'editing.dni.min' => 'El dni debe tener al menos 8 caracteres',
        'editing.dni.max' => 'El dni no debe tener más de 8 caracteres',
        'editing.dni.unique' => 'Este dni ya fue registrado',

        'editing.ruc.min' => 'El ruc debe tener al menos 11 caracteres',
        'editing.ruc.max' => 'El ruc no debe tener más de 11 caracteres',
        'editing.ruc.unique' => 'El ruc ya fue registrado',

        'editing.address.min' => 'La dirección debe tener al menos 5 caracteres',
        'editing.address.max' => 'La dirección no debe tener más de 100 caracteres',
        'editing.address.unique' => 'La dirección ya fue registrado',

        'editing.phone.required' => 'El celular es obligatorio',
        'editing.phone.min' => 'El celular debe tener al menos 9 caracteres',
        'editing.phone.max' => 'El celular no debe tener más de 9 caracteres',
        'editing.phone.unique' => 'El celular ya fue registrado',

        'editing.status.in' => 'El valor es inválido',
        'editing.status.required' => 'El estado es obligatorio',

        'editing.email.unique' => 'Este correo ya fue registrado',
        'editing.email.email' => 'El correo ingresado es inválido',
    ];

    public function mount()
    {
        $this->editing = $this->makeBlankFields();
        $this->statuses = Customer::STATUSES;
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

    public function updatedEditingDni($value)
    {
        if (strlen($value) < 8) {
            return;
        }

        $response = Http::get('https://dniruc.apisperu.com/api/v1/dni/' . $value . '?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImNyYXp5YXJub2xkMDFAZ21haWwuY29tIn0.J8854s4Hy2oclyowM_lWgcGCRoHlXd5i1c6QXLrKORI');
        $data = $response->collect();
        if ($data->count() != 2) {
            $this->showInputs = true;
            $this->editing->name = $data['nombres'] . ' ' . $data['apellidoPaterno'] . ' ' . $data['apellidoMaterno'];
            $rucconsult = '10' . $data['dni'] . $data['codVerifica'];

            $response = Http::get('https://dniruc.apisperu.com/api/v1/ruc/' . $rucconsult . '?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImNyYXp5YXJub2xkMDFAZ21haWwuY29tIn0.J8854s4Hy2oclyowM_lWgcGCRoHlXd5i1c6QXLrKORI');
            $data2 = $response->collect();
            if ($data2->count() != 2) {
                $this->editing->ruc = $rucconsult;
            } else {
                $this->editing->ruc = '';
                $this->emit('error_alert', 'El DNI existe pero no esta registrado al RUC');
            }
        } else {
            $this->emit('error_alert', 'El DNI no existe');
        }
    }

    public function updatedEditingRuc($value)
    {
        if (strlen($value) < 11) {
            return;
        }

        $response = Http::get('https://dniruc.apisperu.com/api/v1/ruc/' . $value . '?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImNyYXp5YXJub2xkMDFAZ21haWwuY29tIn0.J8854s4Hy2oclyowM_lWgcGCRoHlXd5i1c6QXLrKORI');
        $data = $response->collect();
        if ($data->count() != 2) {
            $this->showInputs = true;
            $this->editing->name = $data['razonSocial'];
            $this->editing->address = $data['direccion'];
        } else {
            $this->emit('error_alert', 'El RUC no existe');
        }
    }

    public function updated($label)
    {
        $this->validateOnly($label, $this->rules(), $this->messages);
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
