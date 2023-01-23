<?php

namespace App\Http\Livewire\Ot;

use App\Models\Customer;
use App\Models\Vehicle;
use App\Models\WorkOrder;
use App\Traits\DataTable;
use Carbon\Carbon;
use PDF;
use Livewire\Component;

class OtTable extends Component
{
    use DataTable;

    public $selected = [];
    public $selectedPage = false;

    public $showFilters = false;

    public $filters = [
        'fromDate' => null,
        'toDate' => null,
        'status' => '',
        'customer' => '',
        'vehicle' => '',
    ];

    protected $listeners = ['delete', 'deleteSelected', 'refreshList' => '$refresh'];

    protected $queryString = ['search' => ['except' => '']];

    public function mount()
    {
        $this->sortField = 'code';
        $this->statuses = WorkOrder::STATUSES;
        $this->customers = Customer::pluck('name', 'id');
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
            $q->whereBetween('created_at', [Carbon::parse($this->filters['fromDate'])->format('Y-m-d') . ' 00:00:00', Carbon::parse($this->filters['toDate'])->format('Y-m-d') . ' 23:59:00']))
            ->when($this->search, fn ($q, $search) => $q->where('code', 'like', '%' . $search . '%')
                ->orwhere('odo', 'like', '%' . $search . '%')
                ->withWhereHas('customerUser', fn ($q2) => $q2->where('name', 'like', '%' . $search . '%'))
                ->withWhereHas('vehiclePlate', fn ($q2) => $q2->where('license_plate', 'like', '%' . $search . '%'))
                )
            ->when($this->filters['status'], fn ($q, $status) => $q->where('status', $status))
            ->when($this->filters['customer'], fn ($q, $customer) => $q->where('customer', $customer))
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);
    }

    public function render()
    {
        sleep(0.5); //se toma 2 seg para renderizar
        return view('livewire.ot.ot-table', [
            'works' => $this->works
        ])->extends('layouts.admin.app')->section('content');
    }

    public function delete(WorkOrder $wo)
    {
        $wo->workOrderDetail()->delete();
        $wo->delete();
        $this->emit('success_alert', 'El orden de trabajo fue eliminado');
    }

// public function generatePdf(WorkOrder $wo)
// {
//     $wod = $wo->workOrderDetail()->get();

//     $pdf = PDF::loadView('invoice', ['wo' => $wo, 'wod' => $wod])->setPaper('a4', 'landscape')->stream();
//     return response()->streamDownload(
//         fn () => print($pdf),
//         $wo->code . ' ' . $wo->vehiclePlate->license_plate . ' ' . $wo->customerUser->name . ".pdf"
//     );
// }

    public function exportSelected()
    {
        return response()->streamDownload(function () {
            echo WorkOrder::whereKey($this->selected)->toCsv();
        }, 'Ordenes_trabajo.csv');
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
