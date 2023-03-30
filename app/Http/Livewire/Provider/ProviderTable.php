<?php

namespace App\Http\Livewire\Provider;

use App\Models\Provider;
use App\Traits\DataTable;
use Carbon\Carbon;
use Livewire\Component;

class ProviderTable extends Component
{
    use DataTable;

    public $showFilters = false;
    public $selected = [];
    public $selectedPage = false;
    
    public $statuses = [];
    public $filters = [
        'fromDate' => null,
        'toDate' => null,
        'status' => ''
    ];

    protected $listeners = ['delete', 'deleteSelected', 'exportSelected', 'refreshList' => '$refresh'];

    protected $queryString = ['search' => ['except' => '']];

    public function mount()
    {
        $this->sortField = 'name';
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
        try {
            $provider->delete();
            $this->emit('success_alert', 'Proveedor eliminado');
        } catch (\Throwable $th) {
            $this->emit('error_alert', 'No se puede eliminar el proveedor, ya que se encuentra asociado a una compra');
        }
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

    public function changeStatus(Provider $provider)
    {
        $provider->status = $provider->status === 'activo' ? 'inactivo' : 'activo';
        $provider->save();
        $this->emit('success_alert', 'Estado actualizado');
    }
}
