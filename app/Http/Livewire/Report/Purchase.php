<?php

namespace App\Http\Livewire\Report;

use App\Models\Provider;
use App\Models\Purchase as ModelsPurchase;
use App\Models\PurchaseDetail;
use Carbon\Carbon;
use Livewire\Component;

class Purchase extends Component
{
    public $fromDate,
        $toDate,
        $provider_id,
        $total,
        $purchases,
        $details,
        $purchase_dt,
        $idModal = "detailSaleModal",
        $nameModal,
        $modalsize = "modal-lg";

    public function mount()
    {
        $this->fromDate = null;
        $this->toDate = null;
        $this->total = 0;
        $this->purchases = [];
        $this->details = [];
        $this->purchase_dt = [];
        $this->providers = Provider::pluck('name', 'id');
    }

    public function render()
    {
        return view('livewire.report.purchase')
            ->extends('layouts.admin.app')->section('content');
    }

    public function consult()
    {
        $this->validate([
            'provider_id' => 'required',
            'fromDate' => 'required',
            'toDate' => 'required',
        ], [
            'provider_id.required' => 'El proveedor es obligatorio',
            'fromDate.required' => 'La fecha de inicio es obligatorio',
            'toDate.required' => 'La fecha de fin es obligatorio',
        ]);

        $fd = Carbon::parse($this->fromDate)->format('Y-m-d');
        $td = Carbon::parse($this->toDate)->format('Y-m-d');

        $this->purchases = ModelsPurchase::with('purchaseDetail')
            ->whereBetween('date_purchase', [$fd, $td])
            ->where('provider_id', $this->provider_id)
            ->get();

        // dd($this->purchases);

        $this->total = $this->purchases ?  $this->purchases->sum('total') : 0;
    }

    public function viewDetails(ModelsPurchase $purchase)
    {
        $this->nameModal = "Detalle de la compra " . $purchase->code_purchase;
        $this->details = PurchaseDetail::where('purchase_id', $purchase->id)->get();
        $this->purchase_dt = ModelsPurchase::where('id', $purchase->id)->get();
        $this->dispatchBrowserEvent('open-modal');
    }

    public function closeModal()
    {
        $this->dispatchBrowserEvent('close-modal');
    }
}
