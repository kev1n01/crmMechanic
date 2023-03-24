<?php

namespace App\Http\Livewire\Report;

use App\Models\Concept;
use App\Models\Product;
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
        $dot_modal,
        $id_ot,
        $wo_ids,
        $wo_sid,
        $plates,
        $idModal = "detailOtModal",
        $nameModal,
        $modalsize = "modal-lg";
    protected $listeners = ['refresh' => '$refresh'];

    public function mount()
    {
        $this->fromDate = null;
        $this->toDate = null;
        $this->total = 0;
        $this->total_replacement = 0;
        $this->total_service = 0;
        $this->ots = [];
        // $this->ot_dt = [];
        $this->wo_ids = [];
        $this->wo_sid = [];
        $this->dot_modal = [];
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

        $this->ots = WorkOrder::whereBetween('arrival_date', [$fd, $td])
            ->where('is_confirmed', 1)
            ->where('vehicle', $this->vehicle_plate)
            ->get();

        $dots = workOrderDetail::whereIn('work_order_id', $this->ots->pluck('id'))
            ->get();

        $dots_replacement = $dots->filter(function ($i) {
            return strlen($i->item) > 4;
        });

        foreach ($dots_replacement as $cr) {
            $this->total_replacement += ($cr->price * $cr->quantity) - (($cr->quantity * $cr->price) * ($cr->discount / 100));
        }
        $dots_service = $dots->filter(function ($i) {
            return strlen($i->item) < 4;
        });

        foreach ($dots_service as $cs) {
            $this->total_service += ($cs->price * $cs->quantity) - (($cs->quantity * $cs->price) * ($cs->discount / 100));
        }

        $this->total = $this->ots ?  $this->ots->sum('total') : 0;

        $this->total_service = $dots_service ? $this->total_service : 0;

        $this->total_replacement = $dots_replacement ? $this->total_replacement : 0;

        if ($this->ots->count() > 0) {
            $this->emit('info_alert', 'Se encontraron ' . $this->ots->count() . ' ordenes de trabajo');
        } else {
            $this->emit('info_alert', 'No se encontraron ordenes de trabajo');
        }
    }

    public function viewDetails($id)
    {
        $this->nameModal = "Detalle de orden de trabajo";
        $this->id_ot = $id;
        // dd($this->id_ot);
        // $this->ot_dt = WorkOrder::where('id', $wo->id)->first();
        // $dots = $wo->workOrderDetail()->get();

        // $this->dot_modal = $dots->each(function ($item, $key) {
        //     if (strlen(strval($item->item)) < 4) {
        //         $item->item = Concept::where('code', str_pad($item->item, 3, "0", STR_PAD_LEFT))->select('name', 'code')->first();
        //     } else {
        //         $item->item = Product::where('code', strval($item->item))->select('name', 'code')->first();
        //     }
        // });
        $this->dispatchBrowserEvent('open-modal');
    }

    public function closeModal()
    {
        $this->dispatchBrowserEvent('close-modal');
    }
}
