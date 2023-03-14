<?php

namespace App\Http\Livewire\Vehicle;

use App\Models\BrandVehicle;
use App\Models\ColorVehicle;
use App\Models\Customer;
use App\Models\ModelVehicle;
use App\Models\TypeVehicle;
use App\Models\Vehicle;
use App\Traits\DataTable;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class VehicleTable extends Component
{
    use DataTable;
    public $showFilters = false;
    public $selected = [];
    public $selectedPage = false;

    public $customers = [];
    public $years = [];
    public $types = [];
    public $brands = [];
    public $models = [];
    public $colors = [];
    public $filters = [
        'fromDate' => null,
        'toDate' => null,
        'customer' => '',
        'model_year' => '',
        'type' => '',
        'brand' => '',
        'model' => '',
        'color' => ''
    ];

    protected $listeners = ['delete', 'deleteSelected', 'exportSelected', 'refreshList' => '$refresh'];

    protected $queryString = ['search' => ['except' => '']];

    public function mount()
    {
        $this->sortField = 'license_plate';
        $this->customers = Customer::pluck('name', 'id');
        $this->years = Vehicle::YEARS;
        $this->types = TypeVehicle::pluck('name', 'id');
        $this->brands = BrandVehicle::pluck('name', 'id');
        $this->models = ModelVehicle::pluck('name', 'id');
        $this->colors = ColorVehicle::pluck('name', 'id');
    }

    public function updatedFilters()
    {
        $this->resetPage();
    }

    public function updatedSelectedPage($value)
    {
        $this->selected = $value ? $this->vehicles->pluck('id')->map(fn ($id) => (string) $id) : [];
    }

    public function resetFilters()
    {
        $this->reset('filters');
    }

    public function showFilter()
    {
        $this->showFilters = $this->showFilters ? false : true;
    }

    public function getVehiclesProperty()
    {
        return Vehicle::query()
            ->when($this->search, fn ($q, $search) => $q->where('license_plate', 'like', '%' . $search . '%')
                ->orWhere('model_year', 'like', '%' . $search . '%')->orWhere('odo', 'like', '%' . $search . '%'))
            ->when($this->filters['fromDate'] && $this->filters['toDate'], fn ($q, $created_at) =>
            $q->whereBetween('created_at', [Carbon::parse($this->filters['fromDate'])->format('Y-m-d') . ' 00:00:00', Carbon::parse($this->filters['toDate'])->format('Y-m-d') . ' 23:59:00']))
            ->when($this->filters['customer'], fn ($q, $customer) => $q->where('customer_id', $customer))
            ->when($this->filters['model_year'], fn ($q, $model_year) => $q->where('model_year', $model_year))
            ->when($this->filters['type'], fn ($q, $type) => $q->where('type_vehicle', $type))
            ->when($this->filters['brand'], fn ($q, $brand) => $q->where('brand_vehicle', $brand))
            ->when($this->filters['model'], fn ($q, $model) => $q->where('model_vehicle', $model))
            ->when($this->filters['color'], fn ($q, $color) => $q->where('color_vehicle', $color))
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);
    }

    public function render()
    {
        sleep(0.5); //se toma 2 seg para renderizar
        return view('livewire.vehicle.vehicle-table', [
            'vehicles' => $this->vehicles,
        ])->extends('layouts.admin.app')->section('content');
    }

    public function delete(Vehicle $vehicle)
    {
        $this->removeImage($vehicle->image);
        $vehicle->delete();
    }

    public function exportSelected()
    {
        return response()->streamDownload(function () {
            echo Vehicle::whereKey($this->selected)->toCsv();
        }, 'vehicles.csv');
        $this->emit('success_alert', 'Se exportaron los registros seleccionados');
    }

    public function deleteSelected()
    {
        $vehicle = Vehicle::whereKey($this->selected);
        $vehiclefind = Vehicle::find($this->selected);
        foreach ($vehiclefind as $pf) {
            $this->removeImage($pf['image']);
        }
        $vehicle->delete();
        $this->emit('success_alert', count($this->selected) . ' registros eliminados');
    }

    public function removeImage($image)
    {
        if (!$image) return;
        if (Storage::disk('public')->exists($image)) {
            Storage::disk('public')->delete($image);
        }
    }
}
