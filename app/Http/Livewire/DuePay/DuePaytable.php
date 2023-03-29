<?php

namespace App\Http\Livewire\DuePay;

use App\Models\DuePay;
use App\Models\Sale;
use App\Traits\DataTable;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Livewire\Component;

class DuePaytable extends Component
{
    use DataTable;

    public $showFilters = false;
    public $selected = [];
    public $selectedPage = false;

    public $reasons = [];

    protected $listeners = ['delete', 'refreshList' => '$refresh', 'deleteSelected', 'exportSelected'];

    protected $queryString = ['search' => ['except' => '']];

    public $filters = ['fromDate' => null, 'toDate' => null];

    public function mount()
    {
        $this->sortField = 'description';
        $this->reasons = DuePay::REASONS;
    }

    public function showFilter()
    {
        $this->showFilters = $this->showFilters ? false : true;
    }

    public function getDuesProperty()
    {
        return DuePay::query()
            ->when($this->filters['fromDate'] && $this->filters['toDate'], fn ($q, $created_at) =>
            $q->whereBetween('created_at', [Carbon::parse($this->filters['fromDate'])->format('Y-m-d') . ' 00:00:00', Carbon::parse($this->filters['toDate'])->format('Y-m-d') . ' 23:59:00']))
            ->search('description', $this->search)
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);
    }

    public function render()
    {
        // sleep(0.5); //se toma 2 seg para renderizar
        return view('livewire.due-pay.due-paytable', [
            'dues' => $this->dues,
        ])->extends('layouts.admin.app')->section('content');
    }

    public function resetFilters()
    {
        $this->reset('filters');
    }

    public function delete(DuePay $due)
    {
        $due->delete();
    }

    public function updatedSelectedPage($value)
    {
        $this->selected = $value ? $this->dues->pluck('id')->map(fn ($id) => (string) $id) : [];
    }

    public function exportSelected()
    {
        return response()->streamDownload(function () {
            echo DuePay::whereKey($this->selected)->toCsv();
        }, 'deudas_por_cobrar.csv');
        $this->selected = [];
        $this->emit('success_alert', 'Se exportaron los registros seleccionados');
    }

    public function deleteSelected()
    {
        $dues = DuePay::whereKey($this->selected);
        $dues->delete();
        $this->selected = [];
        $this->emit('success_alert', count($this->selected) . ' registros eliminados');
    }
}
