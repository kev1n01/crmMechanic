<?php

namespace App\Http\Livewire\Report;

use App\Models\Product;
use App\Models\SaleDetail;
use App\Models\Vehicle;
use App\Models\WorkOrder;
use App\Models\workOrderDetail;
use Carbon\Carbon;
use Livewire\Component;
use Termwind\Components\Dd;

class OT extends Component
{
    public $fromDate,
        $toDate,
        $vehicle_plate,
        $total,
        $total_replacement,
        $total_service,
        $ots,
        $wod_service,
        $wod_replacement,
        $ot_dt,
        $wo_ids,
        $wo_sid,
        $idModal = "detailOtModal",
        $nameModal,
        $modalsize = "modal-lg";

    public function mount()
    {
        $this->fromDate = null;
        $this->toDate = null;
        $this->total = 0;
        $this->total_replacement = 0;
        $this->total_service = 0;
        $this->ots = [];
        $this->ot_dt = [];
        $this->wo_ids = [];
        $this->wo_sid = [];
        $this->wod_service = [];
        $this->wod_replacement = [];
        $this->plates = Vehicle::pluck('license_plate', 'id');
    }

    public function render()
    {
        return view('livewire.report.o-t')
            ->extends('layouts.admin.app')->section('content');
    }

    public function consult()
    {
        $this->validate([
            'vehicle_plate' => 'required',
            'fromDate' => 'required',
            'toDate' => 'required',
        ], [
            'vehicle_plate.required' => 'La placa del vehículo es obligatorio',
            'fromDate.required' => 'La fecha de inicio es obligatorio',
            'toDate.required' => 'La fecha de fin es obligatorio',
        ]);

        $this->total_replacement = 0;
        $this->total_service = 0;

        $fd = Carbon::parse($this->fromDate)->format('Y-m-d');
        $td = Carbon::parse($this->toDate)->format('Y-m-d');

        $this->ots = WorkOrder::with('workOrderDetail')
            ->whereBetween('arrival_date', [$fd, $td])
            ->where('vehicle', $this->vehicle_plate)
            ->get();


        $this->total = $this->ots ?  $this->ots->sum('total') : 0;

        $this->ots->each(function ($ids) {
            array_push($this->wo_ids, $ids->id);
            array_push($this->wo_sid, $ids->sale);
        });

        $dots_service = workOrderDetail::whereIn('work_order_id', $this->wo_ids)
            ->get();

        $dots_replacement = SaleDetail::whereIn('sale_id',$this->wo_sid )
            ->get();

        // dd($dots_replacement);

        $dots_service->each(function ($ds) {
            $this->total_service +=  $ds->quantity * $ds->price;
        });

        $dots_replacement->each(function ($ds) {
            $this->total_replacement += $ds->quantity * $ds->price;
        });

        $this->total_service = $dots_service ? $this->total_service : 0;

        $this->total_replacement = $dots_replacement ? $this->total_replacement : 0;
    }

    public function viewDetails(WorkOrder $wo)
    {
        $this->nameModal = "Detalle del orden de trabajo " . $wo->code;
        $this->wod_service = $wo->workOrderDetail()->get();
        $this->wod_replacement = SaleDetail::where('sale_id',$wo->sale )->get();
        $this->ot_dt = WorkOrder::where('id', $wo->id)->get();
        $this->dispatchBrowserEvent('open-modal');
    }

    public function closeModal()
    {
        $this->dispatchBrowserEvent('close-modal');
    }
}
