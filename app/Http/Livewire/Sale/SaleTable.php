<?php

namespace App\Http\Livewire\Sale;

use App\Models\Customer;
use App\Models\Sale;
use App\Traits\DataTable;
use Carbon\Carbon;
use Livewire\Component;

class SaleTable extends Component
{
    use DataTable;

    public $selected = [];
    public $selectedPage = false;
    public $showFilters = false;

    public $statuses = [];
    public $customers = [];
    public $method_payments = [];
    public $type_payments = [];
    public $type_sales = [];

    public $filters = [
        'fromDate' => null,
        'toDate' => null,
        'status' => '',
        'customer' => '',
        'method_payment' => '',
        'type_payment' => '',
        'type_sale' => '',
    ];

    protected $listeners = ['delete', 'deleteSelected', 'exportSelected', 'refreshList' => '$refresh'];

    protected $queryString = ['search' => ['except' => '']];

    public function mount()
    {
        $this->sortField = 'code_sale';
        $this->statuses = Sale::STATUSES;
        $this->method_payments = Sale::METHOD_PAYMENTS;
        $this->type_payments = Sale::TYPE_PAYMENTS;
        $this->type_sales = Sale::TYPES;
        $this->customers = Customer::where('status', 'activo')->pluck('name', 'id');
    }

    public function updatedFilters()
    {
        $this->resetPage();
    }

    public function updatedSelectedPage($value)
    {
        $this->selected = $value ? $this->sales->pluck('id')->map(fn ($id) => (string) $id) : [];
    }

    public function resetFilters()
    {
        $this->reset('filters');
    }

    public function showFilter()
    {
        $this->showFilters = $this->showFilters ? false : true;
    }

    public function getSalesProperty()
    {
        return Sale::query()
            ->when($this->filters['fromDate'] && $this->filters['toDate'], fn ($q, $created_at) =>
            $q->whereBetween('date_sale', [Carbon::parse($this->filters['fromDate'])->format('Y-m-d'), Carbon::parse($this->filters['toDate'])->format('Y-m-d')]))
            ->when($this->search, fn ($q, $search) => $q->where('code_sale', 'like', '%' . $search . '%'))
            ->when($this->filters['status'], fn ($q, $status) => $q->where('status', $status))
            ->when($this->filters['type_sale'], fn ($q, $type_sale) => $q->where('type_sale', $type_sale))
            ->when($this->filters['method_payment'], fn ($q, $method_payment) => $q->where('method_payment', $method_payment))
            ->when($this->filters['type_payment'], fn ($q, $type_payment) => $q->where('type_payment', $type_payment))
            ->when($this->filters['customer'], fn ($q, $customer) => $q->where('customer_id', $customer))
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);
    }

    public function render()
    {
        sleep(0.5); //se toma 2 seg para renderizar
        return view('livewire.sale.sale-table', [
            'sales' => $this->sales
        ])->extends('layouts.admin.app')->section('content');
    }

    public function delete(Sale $sale)
    {
        $sale->saleDetail()->delete();
        $sale->delete();
        $this->emit('success_alert', 'La venta fue eliminada');
    }

    public function exportSelected()
    {
        return response()->streamDownload(function () {
            echo Sale::whereKey($this->selected)->toCsv();
        }, 'ventas.csv');
        $this->emit('success_alert', 'Se exportaron los registros seleccionados');
    }

    public function deleteSelected()
    {
        $sale = Sale::whereKey($this->selected);
        $salefind = Sale::find($this->selected);
        foreach ($salefind as $sf) {
            $sf->saleDetail()->delete();
        }
        $sale->delete();
        $this->emit('success_alert', count($this->selected) . ' registros eliminados');
    }
}
