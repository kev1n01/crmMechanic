<?php

namespace App\Http\Livewire\Product;

use App\Models\UnitProduct;
use App\Traits\DataTable;
use Carbon\Carbon;
use Livewire\Component;

class UnitProductTable extends Component
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

    public function getUnitsProperty()
    {
        return UnitProduct::query()
            ->when($this->filters['fromDate'] && $this->filters['toDate'], fn ($q, $created_at) =>
            $q->whereBetween('created_at', [Carbon::parse($this->filters['fromDate'])->format('Y-m-d') . ' 00:00:00', Carbon::parse($this->filters['toDate'])->format('Y-m-d') . ' 23:59:00']))
            ->when($this->search, fn ($q, $search) => $q->where('name', 'like', '%' . $search . '%')
                ->orWhere('code', 'like', '%' . $search . '%'))
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);
    }

    public function render()
    {
        // sleep(0.5); //se toma 2 seg para renderizar
        return view('livewire.product.unit-product-table', [
            'units' => $this->units,
        ])->extends('layouts.admin.app')->section('content');
    }

    public function resetFilters()
    {
        $this->reset('filters');
    }

    public function delete(UnitProduct $unitProduct)
    {
        $unitProduct->delete();
    }

    public function updatedSelectedPage($value)
    {
        $this->selected = $value ? $this->units->pluck('id')->map(fn ($id) => (string) $id) : [];
    }

    public function exportSelected()
    {
        return response()->streamDownload(function () {
            echo UnitProduct::whereKey($this->selected)->toCsv();
        }, 'unidades_productos.csv');
        $this->selected = [];
        $this->emit('success_alert', 'Se exportaron los registros seleccionados');
    }

    public function deleteSelected()
    {
        $unit = UnitProduct::whereKey($this->selected);
        $unit->delete();
        $this->selected = [];
        $this->emit('success_alert', count($this->selected) . ' registros eliminados');
    }
}
