<?php

namespace App\Http\Livewire\Report;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Customer;
use App\Models\Sale as ModelsSale;
use App\Models\SaleDetail;

class Sale extends Component
{
    public $fromDate,
        $toDate,
        $customer_id,
        $total,
        $total_replacement,
        $total_service,
        $sales,
        $details,
        $sale_dt,
        $idModal = "detailSaleModal",
        $nameModal,
        $modalsize = "modal-lg";

    public function mount()
    {
        $this->fromDate = null;
        $this->toDate = null;
        $this->total = 0;
        $this->total_replacement = 0;
        $this->total_service = 0;
        $this->sales = [];
        $this->details = [];
        $this->sale_dt = [];
        $this->customers = Customer::pluck('name', 'id');
    }

    public function render()
    {
        return view('livewire.report.sale')
            ->extends('layouts.admin.app')->section('content');
    }

    public function consult()
    {
        $this->validate([
            'customer_id' => 'required',
            'fromDate' => 'required',
            'toDate' => 'required',
        ], [
            'customer_id.required' => 'El cliente es obligatorio',
            'fromDate.required' => 'La fecha de inicio es obligatorio',
            'toDate.required' => 'La fecha de fin es obligatorio',
        ]);

        $fd = Carbon::parse($this->fromDate)->format('Y-m-d');
        $td = Carbon::parse($this->toDate)->format('Y-m-d');

        $this->sales = ModelsSale::with('saleDetail')
            ->whereBetween('date_sale', [$fd, $td])
            ->where('customer_id', $this->customer_id)
            ->get();

        // dd($this->sales);

        $this->total = $this->sales ?  $this->sales->sum('total') : 0;
    }

    public function viewDetails(ModelsSale $sale)
    {
        $this->nameModal = "Detalle de la venta " . $sale->code_sale;
        $this->details = SaleDetail::where('sale_id', $sale->id)->get();
        $this->sale_dt = ModelsSale::where('id', $sale->id)->get();
        $this->dispatchBrowserEvent('open-modal');
    }

    public function closeModal()
    {
        $this->dispatchBrowserEvent('close-modal');
    }
}
