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
        $this->editing = $this->makeBlankFields();
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
    /* FOR MODAL */
    public $idModal = 'dueModal';
    public $nameModal;
    public DuePay $editing;

    public function rules()
    {
        return [
            'editing.description' => ['required', Rule::unique('due_pays', 'description')->ignore($this->editing)],
            'editing.person_owed' => ['required'],
            'editing.amount_owed' => ['required'],
            'editing.amount_paid' => ['required'],
            'editing.reason' => 'required|in:' . collect(DuePay::REASONS)->keys()->implode(',')
        ];
    }

    protected $messages = [
        'editing.description.required' => 'La descripcion es obligatorio',
        'editing.description.unique' => 'La descripcion ya fue registrado ',
        'editing.person_owed.required' => 'El nombre del deudor es obligatorio',
        'editing.amount_owed.required' => 'El monto adeudado es obligatorio',
        'editing.amount_paid.required' => 'El monto pagado es obligatorio',
        'editing.reason.required' => 'La razon es obligatorio',
        'editing.reason.in' => 'El valor es invalido',
    ];

    public function save()
    {
        $this->validate();
        if ($this->editing->amount_paid >= $this->editing->amount_owed) {
            $sale = Sale::where('code_sale', $this->editing->description)->first();
            $sale->status = 'pagado';
            $sale->cash = $sale->total;
            $sale->save();
            $this->editing->delete();
        } else {
            $this->editing->save();
        }
        $this->nameModal === 'Crear deuda por cobrar' ? $this->emit('success_alert', 'Deuda por cobrar creada') : $this->emit('success_alert', 'Deuda por cobrar actualizada');
        $this->dispatchBrowserEvent('close-modal');
        $this->emit('refreshList');
    }

    public function updated($label)
    {
        $this->validateOnly($label, $this->rules(), $this->messages);
    }

    public function makeBlankFields()
    {
        return DuePay::make(['amount_owed' => 0, 'amount_paid' => 0, 'reason' => 'otro']); /*para dejar vacios los inpust*/
    }

    public function create()
    {
        if ($this->editing->getKey()) $this->editing = $this->makeBlankFields(); // para preservar cambios en los inputs
        $this->nameModal = 'Crear nueva deuda por cobrar';
        $this->resetErrorBag();
        $this->resetValidation();
        $this->dispatchBrowserEvent('open-modal');
    }

    public function edit(DuePay $due)
    {
        $this->nameModal = 'Editar o pagar deuda por cobrar';
        $this->resetErrorBag();
        $this->resetValidation();
        $this->dispatchBrowserEvent('open-modal');
        if ($this->editing->isNot($due)) $this->editing = $due; // para preservar cambios en los inputs
    }

    public function closeModal()
    {
        $this->dispatchBrowserEvent('close-modal');
    }
}
