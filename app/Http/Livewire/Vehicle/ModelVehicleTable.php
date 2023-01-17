<?php

namespace App\Http\Livewire\Vehicle;

use App\Models\ModelVehicle;
use App\Traits\DataTable;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Livewire\Component;

class ModelVehicleTable extends Component
{
    use DataTable;

    public $showFilters = false;

    protected $listeners = ['delete'];  

    protected $queryString = ['search'=> ['except' => '']];  

    public $filters = ['fromDate' => null, 'toDate' => null];

    public function mount(){ $this->sortField = 'id'; $this->editing = $this->makeBlankFields(); } 

    public function showFilter(){ $this->showFilters = $this->showFilters ? false : true; }

    public function render()
    {
        // sleep(0.5); //se toma 2 seg para renderizar
        return view('livewire.vehicle.model-vehicle-table',[
            'models' => ModelVehicle::query()
            ->when($this->filters['fromDate'] && $this->filters['toDate'], fn ($q, $created_at) => 
                $q->whereBetween('created_at', [Carbon::parse($this->filters['fromDate'])->format('Y-m-d') . ' 00:00:00', Carbon::parse($this->filters['toDate'])->format('Y-m-d') . ' 23:59:00']))
            ->search('name', $this->search)
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage),
            ])->extends('layouts.admin.app')->section('content');
    }
   
    public function delete(ModelVehicle $modelvehicle){ $modelvehicle->delete(); }

    /* FOR MODAL */
    public $idModal = 'modelVehicleModal';
    public $nameModal ;
    public ModelVehicle $editing;
        
    public function rules()
    {
        return [
            'editing.name' => ['required', 'min:4', 'max:20', Rule::unique('model_vehicles', 'name')->ignore($this->editing)],
        ];
    }
    protected $messages = [
        'editing.name.required' => 'El nombre es obligatorio',
        'editing.name.min' => 'El nombre debe tener al menos 5 caracteres',
        'editing.name.max' => 'El nombre no debe tener más de 12 caracteres',
        'editing.name.unique' => 'El modelo ya fue registrado',
    ];
    
    public function save(){
        $this->validate();
        $this->editing->save();        
        $this->nameModal === 'Crear nueva modelo' ? $this->emit('success_alert','Modelo creado') : $this->emit('success_alert','Modelo actualizado');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function makeBlankFields(){ return ModelVehicle::make(); /*para dejar vacios los inpust*/ }
    
    public function create(){
        if($this->editing->getKey()) $this->editing = $this->makeBlankFields(); // para preservar cambios en los inputs
        $this->nameModal = 'Crear nuevo modelo';
        $this->resetErrorBag();
        $this->resetValidation();
        $this->dispatchBrowserEvent('open-modal');
    }

    public function edit(ModelVehicle $modelvehicle){
        $this->nameModal = 'Editar modelo';
        $this->resetErrorBag();
        $this->resetValidation();
        $this->dispatchBrowserEvent('open-modal');
        if($this->editing->isNot($modelvehicle)) $this->editing = $modelvehicle; // para preservar cambios en los inputs
    }

    public function closeModal(){ $this->dispatchBrowserEvent('close-modal'); }
}
