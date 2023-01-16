<?php

namespace App\Http\Livewire\Ot;

use App\Models\Concept;
use App\Traits\DataTable;
use Illuminate\Validation\Rule;
use Livewire\Component;

class ConceptTable extends Component
{
    use DataTable;

    public $showFilters = false;

    protected $listeners = ['delete'];  

    protected $queryString = ['search'=> ['except' => '']];  

    public $filters = ['fromDate' => null, 'toDate' => null, 'type' => ''];

    public function mount(){ $this->sortField = 'id'; $this->editing = $this->makeBlankFields(); $this->types = Concept::TYPES;
     } 

    public function showFilter(){ $this->showFilters = $this->showFilters ? false : true; }

    public function render()
    {
        // sleep(0.5); //se toma 2 seg para renderizar
        return view('livewire.ot.concept-table',[
            'concepts' => Concept::query()
            ->when($this->filters['fromDate'] && $this->filters['toDate'],fn($q) => $q->whereBetween('created_at',[$this->filters['fromDate'].' 00:00:00',$this->filters['toDate'].' 23:59:00']))
            ->when($this->filters['type'], fn ($q, $type) => $q->where('type', $type))
            ->search('name', $this->search)
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage),
            ])->extends('layouts.admin.app')->section('content');
    }
   
    public function delete(Concept $concept){ $concept->delete(); }

    /* FOR MODAL */
    public $idModal = 'conceptModal';
    public $nameModal ;
    public Concept $editing;
        
    public function rules()
    {
        return [
            'editing.name' => ['required', 'min:5', 'max:50', Rule::unique('concepts', 'name')->ignore($this->editing)],
            'editing.type' => 'required|in:' . collect(Concept::TYPES)->keys()->implode(','),

        ];
    }
    protected $messages = [
        'editing.name.required' => 'El nombre es obligatorio',
        'editing.name.min' => 'El nombre debe tener al menos 5 caracteres',
        'editing.name.max' => 'El nombre no debe tener más de 50 caracteres',
        'editing.name.unique' => 'El concepto ya fue registrado',
        'editing.type.in' => 'El valor es inválido',
        'editing.type.required' => 'El tipo es obligatorio',
    ];
    
    public function save(){
        $this->validate();
        $this->editing->save();        
        $this->nameModal === 'Crear nuevo concepto' ? $this->emit('success_alert','Concepto creado') : $this->emit('success_alert','Concepto actualizado');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function makeBlankFields(){ return Concept::make(); /*para dejar vacios los inpust*/ }
    
    public function create(){
        if($this->editing->getKey()) $this->editing = $this->makeBlankFields(); // para preservar cambios en los inputs
        $this->nameModal = 'Crear nueva concepto';
        $this->resetErrorBag();
        $this->resetValidation();
        $this->dispatchBrowserEvent('open-modal');
    }

    public function edit(Concept $concept){
        $this->nameModal = 'Editar concepto';
        $this->resetErrorBag();
        $this->resetValidation();
        $this->dispatchBrowserEvent('open-modal');
        if($this->editing->isNot($concept)) $this->editing = $concept; // para preservar cambios en los inputs
    }

    public function closeModal(){ $this->dispatchBrowserEvent('close-modal'); }
}
