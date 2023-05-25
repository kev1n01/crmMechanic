<?php

namespace App\Http\Livewire\InvoiceForm;

use App\Models\Customer;
use App\Models\Sale;
use App\Models\Vehicle;
use App\Models\WorkOrder;
use App\Traits\DataTable;
use Carbon\Carbon;
use Livewire\Component;

class IFTable extends Component
{
    use DataTable;

    public $confirmations = [];
    public $customers = [];
    public $vehicles = [];

    public $selected = [];
    public $selectedPage = false;

    public $showFilters = false;

    public $filters = [
        'fromDate' => null,
        'toDate' => null,
        'customer' => '',
        'vehicle' => '',
    ];

    protected $listeners = ['delete', 'deleteSelected', 'exportSelected', 'refreshList' => '$refresh'];

    protected $queryString = ['search' => ['except' => '']];

    public function code_random($lenght, $letter = '')
    {
        $cc = Sale::count();
        $code = str_pad($cc + 1, $lenght, "0", STR_PAD_LEFT);
        return $letter . $code;
    }

    public function mount()
    {
        $this->sortField = 'code';
        $this->confirmations = WorkOrder::IS_CONFIRMED;
        $this->customers = Customer::where('status', 'activo')->pluck('name', 'id');
        $this->vehicles = Vehicle::pluck('license_plate', 'id');
    }

    public function updatedFilters()
    {
        $this->resetPage();
    }

    public function updatedSelectedPage($value)
    {
        $this->selected = $value ? $this->works->pluck('id')->map(fn ($id) => (string) $id) : [];
    }

    public function resetFilters()
    {
        $this->reset('filters');
    }

    public function showFilter()
    {
        $this->showFilters = $this->showFilters ? false : true;
    }

    public function getWorksProperty()
    {
        return WorkOrder::query()
            ->when($this->filters['fromDate'] && $this->filters['toDate'], fn ($q, $created_at) =>
            $q->whereBetween('arrival_date', [Carbon::parse($this->filters['fromDate'])->format('Y-m-d'), Carbon::parse($this->filters['toDate'])->format('Y-m-d')]))
            ->when(
                $this->search,
                fn ($q, $search) => $q->where('code', 'like', '%' . $search . '%')
                    ->orwhere('odo', 'like', '%' . $search . '%')
                    ->withWhereHas('customerUser', fn ($q2) => $q2->where('name', 'like', '%' . $search . '%'))
                    ->withWhereHas('vehiclePlate', fn ($q2) => $q2->where('license_plate', 'like', '%' . $search . '%'))
            )
            ->when($this->filters['customer'], fn ($q, $customer) => $q->where('customer', $customer))
            ->when($this->filters['vehicle'], fn ($q, $vehicle) => $q->where('vehicle', $vehicle))
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);
    }

    public function render()
    {
        sleep(0.5); //se toma 2 seg para renderizar
        return view('livewire.invoice-form.i-f-table', [
            'works' => $this->works
        ])->extends('layouts.admin.app')->section('content');
    }

    public function delete(WorkOrder $wo)
    {
        $wo->workOrderDetail()->delete();
        $wo->delete();
        $this->emit('success_alert', 'La proforma fue eliminado');
    }

    public function exportSelected()
    {
        return response()->streamDownload(function () {
            echo WorkOrder::whereKey($this->selected)->toCsv();
        }, 'proformas.csv');
        $this->emit('success_alert', 'Se exportaron los registros seleccionados');
    }

    public function deleteSelected()
    {
        $wo = WorkOrder::whereKey($this->selected);
        $wofind = WorkOrder::find($this->selected);
        foreach ($wofind as $wof) {
            $wof->workOrderDetail()->delete();
        }
        $wo->delete();
        $this->emit('success_alert', count($this->selected) . ' registros eliminados');
    }
}
