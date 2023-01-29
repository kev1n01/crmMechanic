<?php

namespace App\Http\Livewire\Customer;

use App\Models\Customer;
use App\Traits\DataTable;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Termwind\Components\Dd;

class CustomerTable extends Component
{
    use DataTable;

    public $showFilters = false;
    public $selected = [];
    public $selectedPage = false;
    /* FOR MODAL */
    public $idModal = 'customerModal';
    public $nameModal;
    public $statuses;
    public Customer $editing;

    public $filters = [
        'fromDate' => null,
        'toDate' => null,
        'status' => ''
    ];

    protected $listeners = ['delete', 'deleteSelected', 'refreshList' => '$refresh'];

    protected $queryString = ['search' => ['except' => '']];

    public function mount()
    {
        $this->sortField = 'name';
        $this->editing = $this->makeBlankFields();
        $this->statuses = Customer::STATUSES;
    }

    public function updatedFilters()
    {
        $this->resetPage();
    }

    public function updatedSelectedPage($value)
    {
        $this->selected = $value ? $this->customers->pluck('id')->map(fn ($id) => (string) $id) : [];
    }

    public function showFilter()
    {
        $this->showFilters = $this->showFilters ? false : true;
    }

    public function getCustomersProperty()
    {
        return Customer::query()
            ->when($this->filters['fromDate'] && $this->filters['toDate'], fn ($q, $created_at) =>
            $q->whereBetween('created_at', [Carbon::parse($this->filters['fromDate'])->format('Y-m-d') . ' 00:00:00', Carbon::parse($this->filters['toDate'])->format('Y-m-d') . ' 23:59:00']))
            ->when($this->search, fn ($q, $search) => $q->where('name', 'like', '%' . $search . '%')
                ->orWhere('phone', 'like', '%' . $search . '%')->orWhere('address', 'like', '%' . $search . '%')
                ->orWhere('ruc', 'like', '%' . $search . '%')->orWhere('dni', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%'))
            ->when($this->filters['status'], fn ($q, $status) => $q->where('status', $status))
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);
    }

    public function render()
    {
        sleep(0.5); //se toma 2 seg para renderizar
        return view('livewire.customer.customer-table', [
            'customers' => $this->customers,
        ])->extends('layouts.admin.app')->section('content');
    }

    public function resetFilters()
    {
        $this->reset('filters');
    }

    public function delete(Customer $customer)
    {
        $customer->delete();
    }

    public function exportSelected()
    {
        return response()->streamDownload(function () {
            echo Customer::whereKey($this->selected)->toCsv();
        }, 'clientes.csv');
        $this->emit('success_alert', 'Se exportaron los registros seleccionados');
    }

    public function deleteSelected()
    {
        $customers = Customer::whereKey($this->selected);
        $customers->delete();
        $this->emit('success_alert', count($this->selected) . ' registros eliminados');
    }

    /* FOR MODAL */
    public function rules()
    {
        return [
            'editing.name' => ['required', 'min:5', 'max:50', Rule::unique('customers', 'name')->ignore($this->editing)],
            'editing.dni' => ['required', 'min:8', 'max:8', Rule::unique('customers', 'dni')->ignore($this->editing)],
            'editing.ruc' => ['nullable', 'min:11', 'max:11', Rule::unique('customers', 'ruc')->ignore($this->editing)],
            'editing.address' => ['nullable','min:5', 'max:50', Rule::unique('customers', 'address')->ignore($this->editing)],
            'editing.phone' => ['required', 'min:9', 'max:9', Rule::unique('customers', 'phone')->ignore($this->editing)],
            'editing.email' => ['required', 'email', Rule::unique('customers', 'email')->ignore($this->editing)],
            'editing.status' => 'nullable|in:' . collect(Customer::STATUSES)->keys()->implode(','),
        ];
    }

    protected $messages = [
        'editing.name.required' => 'El nombre es obligatorio',
        'editing.name.min' => 'El nombre debe tener al menos 5 caracteres',
        'editing.name.max' => 'El nombre no debe tener más de 50 caracteres',
        'editing.name.unique' => 'Este nombre ya fue registrado',

        'editing.dni.required' => 'El dni es obligatorio',
        'editing.dni.min' => 'El dni debe tener al menos 8 caracteres',
        'editing.dni.max' => 'El dni no debe tener más de 8 caracteres',
        'editing.dni.unique' => 'Este dni ya fue registrado',

        'editing.ruc.min' => 'El ruc debe tener al menos 11 caracteres',
        'editing.ruc.max' => 'El ruc no debe tener más de 11 caracteres',
        'editing.ruc.unique' => 'El ruc ya fue registrado',

        'editing.address.min' => 'La dirección debe tener al menos 5 caracteres',
        'editing.address.max' => 'La dirección no debe tener más de 30 caracteres',
        'editing.address.unique' => 'La dirección ya fue registrado',

        'editing.phone.required' => 'El celular es obligatorio',
        'editing.phone.min' => 'El celular debe tener al menos 9 caracteres',
        'editing.phone.max' => 'El celular no debe tener más de 9 caracteres',
        'editing.phone.unique' => 'El celular ya fue registrado',

        'editing.status.in' => 'El valor es inválido',

        'editing.email.required' => 'El email es obligatorio',
        'editing.email.unique' => 'Este correo ya fue registrado',
        'editing.email.email' => 'El correo ingresado es inválido',
    ];

    public function save()
    {
        $this->validate();
        $this->editing->save();
        $this->nameModal === 'Crear nuevo cliente' ? $this->emit('success_alert', 'Cliente creado') : $this->emit('success_alert', 'Cliente actualizado');
        $this->dispatchBrowserEvent('close-modal');
        $this->emit('refreshList');
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
        $this->dispatchBrowserEvent('open-modal');
    }

    public function edit(Customer $customer)
    {
        $this->nameModal = 'Editar cliente';
        $this->resetErrorBag();
        $this->resetValidation();
        $this->dispatchBrowserEvent('open-modal');
        if ($this->editing->isNot($customer)) $this->editing = $customer; // para preservar cambios en los inputs
    }

    public function closeModal()
    {
        $this->dispatchBrowserEvent('close-modal');
    }

    public function changeStatus(Customer $customer)
    {
        $customer->status = $customer->status === 'activo' ? 'inactivo' : 'activo';
        $customer->save();
        $this->emit('success_alert', 'Estado actualizado');
    }
}
