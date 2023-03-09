<?php

namespace App\Http\Livewire\Vehicle;

use App\Models\TypeVehicle;
use App\Traits\DataTable;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Livewire\Component;

class TypeVehicleTable extends Component
{

    use DataTable;

    public $showFilters = false;
    public $selected = [];
    public $selectedPage = false;

    protected $listeners = ['delete', 'deleteSelected', 'exportSelected', 'refreshList' => '$refresh'];

    protected $queryString = ['search' => ['except' => '']];

    public $filters = ['fromDate' => null, 'toDate' => null];

    public function mount()
    {
        $this->sortField = 'id';
        $this->editing = $this->makeBlankFields();
    }

    public function showFilter()
    {
        $this->showFilters = $this->showFilters ? false : true;
    }

    public function updatedFilters()
    {
        $this->resetPage();
    }

    public function updatedSelectedPage($value)
    {
        $this->selected = $value ? $this->types->pluck('id')->map(fn ($id) => (string) $id) : [];
    }

    public function getTypesProperty()
    {
        return TypeVehicle::query()
            ->when($this->filters['fromDate'] && $this->filters['toDate'], fn ($q, $created_at) =>
            $q->whereBetween('created_at', [Carbon::parse($this->filters['fromDate'])->format('Y-m-d') . ' 00:00:00', Carbon::parse($this->filters['toDate'])->format('Y-m-d') . ' 23:59:00']))->search('name', $this->search)
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);
    }

    public function render()
    {
        sleep(0.5); //se toma 2 seg para renderizar
        return view('livewire.vehicle.type-vehicle-table', [
            'types' => $this->types,
        ])->extends('layouts.admin.app')->section('content');
    }

    public function resetFilters()
    {
        $this->reset('filters');
    }

    public function delete(TypeVehicle $typevehicle)
    {
        $typevehicle->delete();
    }

    public function exportSelected()
    {
        return response()->streamDownload(function () {
            echo TypeVehicle::whereKey($this->selected)->toCsv();
        }, 'tipo_vehiculo.csv');
        $this->selected = [];
        $this->emit('success_alert', 'Se exportaron los registros seleccionados');
    }

    public function deleteSelected()
    {
        $types = TypeVehicle::whereKey($this->selected);
        $types->delete();
        $this->selected = [];
        $this->emit('success_alert', count($this->selected) . ' registros eliminados');
    }

    /* FOR MODAL */
    public $idModal = 'typeVehicle';
    public $nameModal;
    public TypeVehicle $editing;

    public function rules()
    {
        return [
            'editing.name' => ['required', 'min:3', 'max:20', Rule::unique('type_vehicles', 'name')->ignore($this->editing)],
        ];
    }
    protected $messages = [
        'editing.name.required' => 'El nombre es obligatorio',
        'editing.name.min' => 'El nombre debe tener al menos 5 caracteres',
        'editing.name.max' => 'El nombre no debe tener más de 12 caracteres',
        'editing.name.unique' => 'EL tipo de vehiculo ya fue registrado',
    ];

    public function save()
    {
        $this->validate();
        $this->editing->save();
        $this->nameModal === 'Crear nuevo tipo de vehiculo ' ? $this->emit('success_alert', 'Tipo de vehiculo creada') : $this->emit('success_alert', 'Tipo de vehiculo actualizado');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function makeBlankFields()
    {
        return TypeVehicle::make(); /*para dejar vacios los inpust*/
    }

    public function create()
    {
        if ($this->editing->getKey()) $this->editing = $this->makeBlankFields(); // para preservar cambios en los inputs
        $this->nameModal = 'Crear nuevo tipo de vehiculo ';
        $this->resetErrorBag();
        $this->resetValidation();
        $this->dispatchBrowserEvent('open-modal');
    }

    public function edit(TypeVehicle $typevehicle)
    {
        $this->nameModal = 'Editar tipo de vehiculo ';
        $this->resetErrorBag();
        $this->resetValidation();
        $this->dispatchBrowserEvent('open-modal');
        if ($this->editing->isNot($typevehicle)) $this->editing = $typevehicle; // para preservar cambios en los inputs
    }

    public function closeModal()
    {
        $this->dispatchBrowserEvent('close-modal');
    }
}
