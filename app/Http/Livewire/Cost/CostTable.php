<?php

namespace App\Http\Livewire\Cost;

use App\Traits\DataTable;
use Livewire\Component;
use App\Models\Cost;
use Carbon\Carbon;

class CostTable extends Component
{
    use DataTable;

    public $showFilters = false;
    public $selected = [];
    public $selectedPage = false;
    /* FOR MODAL */
    public $idModal = 'costModal';
    public $nameModal;
    public Cost $editing;

    public $filters = [
        'fromDate' => null,
        'toDate' => null,
    ];

    protected $listeners = ['delete', 'deleteSelected', 'refreshList' => '$refresh'];

    protected $queryString = ['search' => ['except' => '']];

    public function mount()
    {
        $this->sortField = 'description';
        $this->editing = $this->makeBlankFields();
    }

    public function updatedFilters()
    {
        $this->resetPage();
    }

    public function updatedSelectedPage($value)
    {
        $this->selected = $value ? $this->costs->pluck('id')->map(fn ($id) => (string) $id) : [];
    }

    public function resetFilters()
    {
        $this->reset('filters');
    }

    public function showFilter()
    {
        $this->showFilters = $this->showFilters ? false : true;
    }

    public function getCostsProperty()
    {
        return Cost::query()
            ->when($this->filters['fromDate'] && $this->filters['toDate'], fn ($q, $created_at) =>
            $q->whereBetween('date', [Carbon::parse($this->filters['fromDate'])->format('Y-m-d') . ' 00:00:00', Carbon::parse($this->filters['toDate'])->format('Y-m-d') . ' 23:59:00']))
            ->when($this->search, fn ($q, $search) => $q->where('description', 'like', '%' . $search . '%'))
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);
    }

    public function render()
    {
        sleep(0.5); //se toma 2 seg para renderizar
        return view('livewire.cost.cost-table', [
            'costs' => $this->costs,
        ])->extends('layouts.admin.app')->section('content');
    }

    public function delete(Cost $cost)
    {
        $cost->delete();
    }

    public function exportSelected()
    {
        return response()->streamDownload(function () {
            echo Cost::whereKey($this->selected)->toCsv();
        }, 'costs.csv');
        $this->emit('success_alert', 'Se exportaron los registros seleccionados');
    }

    public function deleteSelected()
    {
        $costs = Cost::whereKey($this->selected);
        $costs->delete();
        $this->emit('success_alert', count($this->selected) . ' registros eliminados');
    }

    /* FOR MODAL */
    public function rules()
    {
        return [
            'editing.description' => ['required', 'min:5', 'max:40'],
            'editing.date' => ['required'],
            'editing.total' => ['required'],
        ];
    }

    protected $messages = [
        'editing.description.required' => 'La descripción es obligatorio',
        'editing.description.min' => 'La descripción  debe tener al menos 5 caracteres',
        'editing.description.max' => 'La descripción no debe tener más de 40 caracteres',
        'editing.date.required' => 'La fecha es obligatorio',
        'editing.total.required' => 'El costo es obligatorio',
    ];

    public function save()
    {
        $this->validate();
        $this->editing->date = Carbon::parse($this->editing->date)->format('Y-m-d');
        $this->editing->save();
        $this->nameModal === 'Registrar nuevo gasto' ? $this->emit('success_alert', 'Gasto registrado') : $this->emit('success_alert', 'Gasto actualizado');
        $this->dispatchBrowserEvent('close-modal');
        $this->emit('refreshList');
    }

    public function updated($label)
    {
        $this->validateOnly($label, $this->rules(), $this->messages);
    }

    public function makeBlankFields()
    {
        return Cost::make(['date' => Carbon::now()->format('d-m-Y')]); /*para dejar vacios los inpust*/
    }

    public function create()
    {
        if ($this->editing->getKey()) $this->editing = $this->makeBlankFields(); // para preservar cambios en los inputs
        $this->nameModal = 'Registrar nuevo gasto';
        $this->resetErrorBag();
        $this->resetValidation();
        $this->dispatchBrowserEvent('open-modal');
    }

    public function edit(Cost $cost)
    {
        $this->nameModal = 'Editar gasto';
        $this->resetErrorBag();
        $this->resetValidation();
        $this->dispatchBrowserEvent('open-modal');
        if ($this->editing->isNot($cost)) $this->editing = $cost; // para preservar cambios en los inputs
    }

    public function closeModal()
    {
        $this->dispatchBrowserEvent('close-modal');
    }
}
