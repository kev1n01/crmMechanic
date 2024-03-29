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

    public $statuses = [];
    public $providers = [];

    public $filters = [
        'fromDate' => null,
        'toDate' => null,
        'status' => '',
        'provider' => '',
    ];

    protected $listeners = ['delete', 'deleteSelected', 'refreshList' => '$refresh', 'exportSelected'];

    protected $queryString = ['search' => ['except' => '']];

    public function mount()
    {
        $this->search = '';
        $this->sortField = 'code_purchase';
        $this->statuses = Purchase::STATUSES;
        $this->providers = Provider::where('status', 'activo')->pluck('name', 'id');
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
            $q->whereBetween('date_purchase', [Carbon::parse($this->filters['fromDate'])->format('Y-m-d'), Carbon::parse($this->filters['toDate'])->format('Y-m-d')]))
            ->when($this->search, fn ($q, $search) => $q->where('code_purchase', 'like', '%' . $search . '%')
                ->orwhere('total', 'like', '%' . $search . '%')
                ->orwhere(fn ($q) => $q->whereHas('provider', fn ($q2) => $q2->where('name', 'like', '%' . $search . '%'))))
            ->when($this->filters['status'], fn ($q, $status) => $q->where('status', $status))
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
        $this->emit('success_alert', 'La compra fue eliminada');
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

    public function changeStatus(Purchase $purchase)
    {
        if ($purchase->status === 'pendiente') {
            $purchase->status = 'recibido';
            $purchase->purchaseDetail()->get()->each(function ($detail) {
                $detail->product->stock += $detail->quantity;
                if ($detail->product->purchase_price == 0) {
                    $detail->product->purchase_price = $detail->price;
                }
                $detail->product->save();
            });
            $purchase->save();
            $this->emit('success_alert', 'El estado de la compra fue cambiado');
        } else {
            $this->emit('info_alert', 'La compra ya fue recibida');
        }
    }
}
