<?php

namespace App\Http\Livewire\Vehicle;

use App\Models\BrandVehicle;
use App\Traits\DataTable;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Livewire\Component;

class BrandVehicleTable extends Component
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
    }

    public function updatedFilters()
    {
        $this->resetPage();
    }

    public function updatedSelectedPage($value)
    {
        $this->selected = $value ? $this->brands->pluck('id')->map(fn ($id) => (string) $id) : [];
    }

    public function showFilter()
    {
        $this->showFilters = $this->showFilters ? false : true;
    }

    public function getBrandsProperty()
    {
        return BrandVehicle::query()
        ->when($this->filters['fromDate'] && $this->filters['toDate'], fn ($q, $created_at) =>
        $q->whereBetween('created_at', [Carbon::parse($this->filters['fromDate'])->format('Y-m-d') . ' 00:00:00', Carbon::parse($this->filters['toDate'])->format('Y-m-d') . ' 23:59:00']))->search('name', $this->search)
        ->orderBy($this->sortField, $this->sortDirection)
        ->paginate($this->perPage);
    }

    public function render()
    {
        sleep(0.5); //se toma 2 seg para renderizar
        return view('livewire.vehicle.brand-vehicle-table', [
            'brands' => $this->brands,
        ])->extends('layouts.admin.app')->section('content');
    }

    public function resetFilters()
    {
        $this->reset('filters');
    }

    public function delete(BrandVehicle $brandvehicle)
    {
        $brandvehicle->delete();
    }
    
    public function exportSelected()
    {
        return response()->streamDownload(function () {
            echo BrandVehicle::whereKey($this->selected)->toCsv();
        }, 'tipo_vehiculos.csv');
        $this->selected = [];
        $this->emit('success_alert', 'Se exportaron los registros seleccionados');
    }

    public function deleteSelected()
    {
        $type_vehicles = BrandVehicle::whereKey($this->selected);
        $type_vehicles->delete();
        $this->selected = [];
        $this->emit('success_alert', count($this->selected) . ' registros eliminados');
    }
}
