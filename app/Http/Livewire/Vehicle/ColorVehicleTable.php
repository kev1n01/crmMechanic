<?php

namespace App\Http\Livewire\Vehicle;

use App\Models\ColorVehicle;
use App\Traits\DataTable;
use Carbon\Carbon;
use Livewire\Component;

class ColorVehicleTable extends Component
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
        $this->selected = $value ? $this->colors->pluck('id')->map(fn ($id) => (string) $id) : [];
    }

    public function getColorsProperty()
    {
        return ColorVehicle::query()
            ->when($this->filters['fromDate'] && $this->filters['toDate'], fn ($q, $created_at) =>
            $q->whereBetween('created_at', [Carbon::parse($this->filters['fromDate'])->format('Y-m-d') . ' 00:00:00', Carbon::parse($this->filters['toDate'])->format('Y-m-d') . ' 23:59:00']))->search('name', $this->search)
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);
    }

    public function render()
    {
        // sleep(0.5); //se toma 2 seg para renderizar
        return view('livewire.vehicle.color-vehicle-table', [
            'colors' => $this->colors,
        ])->extends('layouts.admin.app')->section('content');
    }

    public function resetFilters()
    {
        $this->reset('filters');
    }

    public function delete(ColorVehicle $colorvehicle)
    {
        $colorvehicle->delete();
    }

    public function exportSelected()
    {
        return response()->streamDownload(function () {
            echo ColorVehicle::whereKey($this->selected)->toCsv();
        }, 'color_vehiculo.csv');
        $this->selected = [];
        $this->emit('success_alert', 'Se exportaron los registros seleccionados');
    }

    public function deleteSelected()
    {
        $colors = ColorVehicle::whereKey($this->selected);
        $colors->delete();
        $this->selected = [];
        $this->emit('success_alert', count($this->selected) . ' registros eliminados');
    }
}
