<?php

namespace App\Http\Livewire\Purchase;

use App\Models\Provider;
use App\Models\Purchase;
use App\Models\User;
use App\Traits\DataTable;
use Carbon\Carbon;
use Livewire\Component;

class PurchaseTable extends Component
{
    use DataTable;

    public $selected = [];
    public $selectedPage = false;

    public $showFilters = false;

    public $filters = [
        'fromDate' => null,
        'toDate' => null,
        'status' => '',
        'provider' => '',
        'buyer' => '',
    ];

    protected $listeners = ['delete', 'deleteSelected', 'refreshList' => '$refresh'];

    protected $queryString = ['search' => ['except' => '']];

    public function mount()
    {
        $this->sortField = 'code_purchase';
        $this->statuses = Purchase::STATUSES;
        $this->buyers = User::pluck('name', 'id');
        $this->providers = Provider::pluck('name', 'id');
    }

    public function updatedFilters()
    {
        $this->resetPage();
    }

    public function updatedSelectedPage($value)
    {
        $this->selected = $value ? $this->purchases->pluck('id')->map(fn ($id) => (string) $id) : [];
    }

    public function resetFilters()
    {
        $this->reset('filters');
    }

    public function showFilter()
    {
        $this->showFilters = $this->showFilters ? false : true;
    }

    public function getPurchasesProperty()
    {
        return Purchase::query()
            ->when($this->filters['fromDate'] && $this->filters['toDate'], fn ($q, $created_at) => 
                $q->whereBetween('created_at', [Carbon::parse($this->filters['fromDate'])->format('Y-m-d') . ' 00:00:00', Carbon::parse($this->filters['toDate'])->format('Y-m-d') . ' 23:59:00']))            ->when($this->search, fn ($q, $search) => $q->where('code_purchase', 'like', '%' . $search . '%'))
            ->when($this->filters['status'], fn ($q, $status) => $q->where('status', $status))
            ->when($this->filters['buyer'], fn ($q, $buyer) => $q->where('user_id', $buyer))
            ->when($this->filters['provider'], fn ($q, $provider) => $q->where('provider_id', $provider))
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);
    }

    public function render()
    {
        sleep(0.5); //se toma 2 seg para renderizar
        return view('livewire.purchase.purchase-table', [
            'purchases' => $this->purchases
        ])->extends('layouts.admin.app')->section('content');
    }

    public function delete(Purchase $purchase)
    {
        $purchase->purchaseDetail()->delete();
        $purchase->delete();
        $this->emit('success_alert','La compra fue eliminada');
    }

    public function exportSelected()
    {
        return response()->streamDownload(function () {
            echo Purchase::whereKey($this->selected)->toCsv();
        }, 'compras.csv');
        $this->emit('success_alert', 'Se exportaron los registros seleccionados');
    }

    public function deleteSelected()
    {
        $purchase = Purchase::whereKey($this->selected);
        $purchasefind = Purchase::find($this->selected);
        foreach ($purchasefind as $pf) {
            $pf->purchaseDetail()->delete();
        }
        $purchase->delete();
        $this->emit('success_alert', count($this->selected) . ' registros eliminados');
    }
}
