<?php

namespace App\Http\Livewire\Report;

use App\Models\Vehicle;
use App\Models\WorkOrder;
use App\Models\workOrderDetail;
use Carbon\Carbon;
use Livewire\Component;

class OT extends Component
{
    public $fromDate,
        $toDate,
        $vehicle_plate,
        $total,
        $total_replacement,
        $total_service,
        $ots,
        $details,
        $ot_dt,
        $wo_ids,
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
        $this->details = [];
        $this->ot_dt = [];
        $this->wo_ids = [];
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

        $fd = Carbon::parse($this->fromDate)->format('Y-m-d') . ' 00:00:00';
        $td = Carbon::parse($this->toDate)->format('Y-m-d') . ' 23:59:59';

        $this->ots = WorkOrder::with('workOrderDetail')
            ->whereBetween('created_at', [$fd, $td])
            ->where('vehicle', $this->vehicle_plate)
            ->get();

        // dd($this->ots);

        $this->total = $this->ots ?  $this->ots->sum('total') : 0;

        $this->ots->each(function ($ids) {
            array_push($this->wo_ids, $ids->id);
        });

        $dots_service = workOrderDetail::whereIn('work_order_id', $this->wo_ids)
            ->withWhereHas('concept', function ($query) {
                $query->where('type', 'servicio');
            })->get();

        $dots_replacement = workOrderDetail::whereIn('work_order_id', $this->wo_ids)
            ->withWhereHas('concept', function ($query) {
                $query->where('type', 'repuesto');
            })->get();

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
        $this->details = workOrderDetail::where('work_order_id', $wo->id)->get();
        $this->ot_dt = WorkOrder::where('id', $wo->id)->get();
        $this->dispatchBrowserEvent('open-modal');
    }

    public function closeModal()
    {
        $this->dispatchBrowserEvent('close-modal');
    }
}
