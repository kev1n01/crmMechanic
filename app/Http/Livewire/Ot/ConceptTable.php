<?php

namespace App\Http\Livewire\Ot;

use App\Models\Concept;
use App\Traits\DataTable;
use Carbon\Carbon;
use Livewire\Component;

class ConceptTable extends Component
{
    use DataTable;

    public $showFilters = false;
    public $selected = [];
    public $selectedPage = false;

    protected $listeners = ['delete', 'deleteSelected', 'exportSelected', 'refreshList' => '$refresh'];

    protected $queryString = ['search' => ['except' => '']];

    public $filters = ['fromDate' => null, 'toDate' => null];

    public function mount()
    {
        $this->sortField = 'code';
    }

    public function showFilter()
    {
        $this->showFilters = $this->showFilters ? false : true;
    }

    public function updatedFilters()
    {
        $this->resetPage();
    }

    public function updatedSelectedPage($value)
    {
        $this->selected = $value ? $this->concepts->pluck('id')->map(fn ($id) => (string) $id) : [];
    }

    public function getConceptsProperty()
    {
        return Concept::query()
            ->when($this->filters['fromDate'] && $this->filters['toDate'], fn ($q, $created_at) =>
            $q->whereBetween('created_at', [Carbon::parse($this->filters['fromDate'])->format('Y-m-d') . ' 00:00:00', Carbon::parse($this->filters['toDate'])->format('Y-m-d') . ' 23:59:00']))
            ->search('name', $this->search)
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);
    }

    public function render()
    {
        // sleep(0.5); //se toma 2 seg para renderizar
        return view('livewire.ot.concept-table', [
            'concepts' => $this->concepts,
        ])->extends('layouts.admin.app')->section('content');
    }

    public function resetFilters()
    {
        $this->reset('filters');
    }

    public function delete(Concept $concept)
    {
        $concept->delete();
    }
    
    public function exportSelected()
    {
        return response()->streamDownload(function () {
            echo Concept::whereKey($this->selected)->toCsv();
        }, 'servicios.csv');
        $this->selected = [];
        $this->emit('success_alert', 'Se exportaron los registros seleccionados');
    }

    public function deleteSelected()
    {
        $concepts = Concept::whereKey($this->selected);
        $concepts->delete();
        $this->selected = [];
        $this->emit('success_alert', count($this->selected) . ' registros eliminados');
    }

}
