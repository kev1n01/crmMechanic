<?php

namespace App\Http\Livewire\Provider;

use App\Models\Provider;
use App\Traits\DataTable;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Validation\Rule;

class ProviderTable extends Component
{
    use DataTable;

    public $showFilters = false;
    public $selected = [];
    public $selectedPage = false;
    /* FOR MODAL */
    public $idModal = 'providerModal';
    public $nameModal;
    public $statuses;
    public Provider $editing;

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
        $this->statuses = Provider::STATUSES;
    }

    public function updatedFilters()
    {
        $this->resetPage();
    }

    public function updatedSelectedPage($value)
    {
        $this->selected = $value ? $this->providers->pluck('id')->map(fn ($id) => (string) $id) : [];
    }

    public function showFilter()
    {
        $this->showFilters = $this->showFilters ? false : true;
    }

    public function getProvidersProperty()
    {
        return Provider::query()
            ->when($this->filters['fromDate'] && $this->filters['toDate'], fn ($q, $created_at) =>
            $q->whereBetween('created_at', [Carbon::parse($this->filters['fromDate'])->format('Y-m-d') . ' 00:00:00', Carbon::parse($this->filters['toDate'])->format('Y-m-d') . ' 23:59:00']))
            ->when($this->search, fn ($q, $search) => $q->where('name', 'like', '%' . $search . '%')
                ->orWhere('phone', 'like', '%' . $search . '%')->orWhere('address', 'like', '%' . $search . '%')->orWhere('ruc', 'like', '%' . $search . '%'))
            ->when($this->filters['status'], fn ($q, $status) => $q->where('status', $status))
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);
    }

    public function render()
    {
        sleep(0.5); //se toma 2 seg para renderizar
        return view('livewire.provider.provider-table', [
            'providers' => $this->providers,
        ])->extends('layouts.admin.app')->section('content');
    }

    public function resetFilters()
    {
        $this->reset('filters');
    }

    public function delete(Provider $provider)
    {
        $provider->delete();
    }

    public function exportSelected()
    {
        return response()->streamDownload(function () {
            echo Provider::whereKey($this->selected)->toCsv();
        }, 'proveedores.csv');
        $this->selected = [];
        $this->emit('success_alert', 'Se exportaron los registros seleccionados');
    }

    public function deleteSelected()
    {
        $providers = Provider::whereKey($this->selected);
        $providers->delete();
        $this->selected = [];
        $this->emit('success_alert', count($this->selected) . ' registros eliminados');
    }

    /* FOR MODAL */
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
        $this->dispatchBrowserEvent('close-modal');
        $this->emit('refreshList');
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
        $this->dispatchBrowserEvent('open-modal');
    }

    public function edit(Provider $provider)
    {
        $this->nameModal = 'Editar proveedor';
        $this->resetErrorBag();
        $this->resetValidation();
        $this->dispatchBrowserEvent('open-modal');
        if ($this->editing->isNot($provider)) $this->editing = $provider; // para preservar cambios en los inputs
        $this->emit('refreshList');
    }

    public function closeModal()
    {
        $this->dispatchBrowserEvent('close-modal');
    }

    public function changeStatus(Provider $provider)
    {
        $provider->status = $provider->status === 'activo' ? 'inactivo' : 'activo';
        $provider->save();
        $this->emit('success_alert', 'Estado actualizado');
    }
}
