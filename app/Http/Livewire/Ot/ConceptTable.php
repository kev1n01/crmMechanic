<?php

namespace App\Http\Livewire\Ot;

use App\Models\Concept;
use App\Traits\DataTable;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Livewire\Component;

class ConceptTable extends Component
{
    use DataTable;

    public $showFilters = false;

    protected $listeners = ['delete'];

    protected $queryString = ['search' => ['except' => '']];

    public $filters = ['fromDate' => null, 'toDate' => null];

    public function code_random($lenght, $letter = '')
    {
        $cc = Concept::count();
        $code = str_pad($cc + 1, $lenght, "0", STR_PAD_LEFT);
        return $letter . '' . $code;
    }

    public function mount()
    {
        $this->sortField = 'code';
        $this->editing = $this->makeBlankFields();
        $this->editing->code = $this->code_random(3);
    }

    public function showFilter()
    {
        $this->showFilters = $this->showFilters ? false : true;
    }

    public function render()
    {
        // sleep(0.5); //se toma 2 seg para renderizar
        return view('livewire.ot.concept-table', [
            'concepts' => Concept::query()
                ->when($this->filters['fromDate'] && $this->filters['toDate'], fn ($q, $created_at) =>
                $q->whereBetween('created_at', [Carbon::parse($this->filters['fromDate'])->format('Y-m-d') . ' 00:00:00', Carbon::parse($this->filters['toDate'])->format('Y-m-d') . ' 23:59:00']))
                ->search('name', $this->search)
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->perPage),
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

    /* FOR MODAL */
    public $idModal = 'conceptModal';
    public $nameModal;
    public Concept $editing;

    public function rules()
    {
        return [
            'editing.code' => ['required', 'min:6', 'max:6', Rule::unique('concepts', 'code')->ignore($this->editing)],
            'editing.name' => ['required', 'min:5', 'max:50', Rule::unique('concepts', 'name')->ignore($this->editing)],

        ];
    }
    protected $messages = [
        'editing.name.required' => 'El nombre es obligatorio',
        'editing.name.min' => 'El nombre debe tener al menos 5 caracteres',
        'editing.name.max' => 'El nombre no debe tener más de 50 caracteres',
        'editing.name.unique' => 'El servicio ya fue registrado',
        'editing.code.required' => 'El codigo es obligatorio',
        'editing.code.min' => 'El codigo debe tener al menos 6 caracteres',
        'editing.code.max' => 'El codigo no debe tener más de 6 caracteres',
        'editing.code.unique' => 'El codigo ya fue registrado',
    ];

    public function save()
    {
        $this->validate();
        $this->editing->save();
        $this->nameModal === 'Crear nuevo servicio' ? $this->emit('success_alert', 'Servicio creado') : $this->emit('success_alert', 'Servicio actualizado');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function makeBlankFields()
    {
        return Concept::make(); /*para dejar vacios los inpust*/
    }

    public function create()
    {
        if ($this->editing->getKey()) $this->editing = $this->makeBlankFields(); // para preservar cambios en los inputs
        $this->nameModal = 'Crear nuevo servicio';
        $this->resetErrorBag();
        $this->resetValidation();
        $this->dispatchBrowserEvent('open-modal');
    }

    public function edit(Concept $concept)
    {
        $this->nameModal = 'Editar servicio';
        $this->resetErrorBag();
        $this->resetValidation();
        $this->dispatchBrowserEvent('open-modal');
        if ($this->editing->isNot($concept)) $this->editing = $concept; // para preservar cambios en los inputs
    }

    public function closeModal()
    {
        $this->dispatchBrowserEvent('close-modal');
    }
}
