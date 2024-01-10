<?php

namespace App\Http\Livewire\Sunat;

use App\Models\Comprobant;
use App\Models\Customer;
use App\Traits\DataTable;
use Carbon\Carbon;
use Livewire\Component;

class ComprobantTable extends Component
{
    use DataTable;

    public $selected = [];
    public $selectedPage = false;
    public $showFilters = false;

    public $statuses = [];
    public $customers = [];
    public $type_payments = [];
    public $type_cpes = [];

    public $filters = [
        'fromDate' => null,
        'toDate' => null,
        'customer' => '',
        'type_cpe' => '',
        'type_payment' => '',
    ];

    protected $listeners = ['delete', 'deleteSelected', 'exportSelected', 'refreshList' => '$refresh'];

    protected $queryString = ['search' => ['except' => '']];

    public function mount()
    {
        $this->sortField = 'correlativo';
        // $this->statuses = Comprobant::STATUSES;
        $this->type_cpes = Comprobant::TYPE_CPE;
        $this->type_payments = Comprobant::TYPE_PAYMENTS;
        $this->customers = Customer::where('status', 'activo')->pluck('name', 'num_doc');
    }

    public function updatedFilters()
    {
        $this->resetPage();
    }

    public function updatedSelectedPage($value)
    {
        $this->selected = $value ? $this->comprobant->pluck('id')->map(fn ($id) => (string) $id) : [];
    }

    public function resetFilters()
    {
        $this->reset('filters');
    }

    public function showFilter()
    {
        $this->showFilters = $this->showFilters ? false : true;
    }

    public function getComprobantProperty()
    {
        return Comprobant::query()
            ->when($this->filters['fromDate'] && $this->filters['toDate'], fn ($q, $created_at) =>
            $q->whereBetween('fechaEmision', [Carbon::parse($this->filters['fromDate'])->format('Y-m-d'), Carbon::parse($this->filters['toDate'])->format('Y-m-d')]))
            ->when($this->search, fn ($q, $search) => $q->where('correlativo', 'like', '%' . $search . '%'))
            ->when($this->filters['type_cpe'], fn ($q, $type_cpe) => $q->where('tipoDoc', $type_cpe))
            ->when($this->filters['type_payment'], fn ($q, $type_payment) => $q->where('tipoPago', $type_payment))
            ->when($this->filters['customer'], fn ($q, $customer) => $q->whereJsonContains('cliente->numDoc', $customer))
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);
    }

    public function render()
    {
        sleep(0.5); //se toma 2 seg para renderizar
        return view('livewire.sunat.comprobant-table', [
            'comprobants' => $this->comprobant
        ])->extends('layouts.admin.app')->section('content');
    }

    public function delete(Comprobant $comprobant)
    {
        $comprobant->delete();
        $this->emit('success_alert', 'El comprobante fue eliminado');
    }

    public function exportSelected()
    {
        return response()->streamDownload(function () {
            echo Comprobant::whereKey($this->selected)->toCsv();
        }, 'comprobantes' . date('d-m-Y') . '.csv');
        $this->emit('success_alert', 'Se exportaron los registros seleccionados');
    }

    public function deleteSelected()
    {
        $sales = Comprobant::whereKey($this->selected);
        $sales->delete();
        $this->emit('success_alert', count($this->selected) . ' registros eliminados');
    }
}
