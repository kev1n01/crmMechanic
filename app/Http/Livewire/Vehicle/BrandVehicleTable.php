<?php

namespace App\Http\Livewire\Vehicle;

use App\Models\BrandVehicle;
use App\Traits\DataTable;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Livewire\Component;

class BrandVehicleTable extends Component
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
        return view('livewire.vehicle.brand-vehicle-table',[
            'brands' => BrandVehicle::query()
            ->when($this->filters['fromDate'] && $this->filters['toDate'], fn ($q, $created_at) => 
                $q->whereBetween('created_at', [Carbon::parse($this->filters['fromDate'])->format('Y-m-d') . ' 00:00:00', Carbon::parse($this->filters['toDate'])->format('Y-m-d') . ' 23:59:00']))            ->search('name', $this->search)
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage),
            ])->extends('layouts.admin.app')->section('content');
    }
   
    public function delete(BrandVehicle $brandvehicle){ $brandvehicle->delete(); }

    /* FOR MODAL */
    public $idModal = 'brandVehicleModal';
    public $nameModal ;
    public BrandVehicle $editing;
        
    public function rules()
    {
        return [
            'editing.name' => ['required', 'min:2', 'max:20', Rule::unique('brand_vehicles', 'name')->ignore($this->editing)],
        ];
    }
    protected $messages = [
        'editing.name.required' => 'El nombre es obligatorio',
        'editing.name.min' => 'El nombre debe tener al menos 5 caracteres',
        'editing.name.max' => 'El nombre no debe tener más de 12 caracteres',
        'editing.name.unique' => 'La marca ya fue registrado',
    ];
    
    public function save(){
        $this->validate();
        $this->editing->save();        
        $this->nameModal === 'Crear nueva marca' ? $this->emit('success_alert','Marca creada') : $this->emit('success_alert','Marca actualizada');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function makeBlankFields(){ return BrandVehicle::make(); /*para dejar vacios los inpust*/ }
    
    public function create(){
        if($this->editing->getKey()) $this->editing = $this->makeBlankFields(); // para preservar cambios en los inputs
        $this->nameModal = 'Crear nueva marca';
        $this->resetErrorBag();
        $this->resetValidation();
        $this->dispatchBrowserEvent('open-modal');
    }

    public function edit(BrandVehicle $brandvehicle){
        $this->nameModal = 'Editar marca';
        $this->resetErrorBag();
        $this->resetValidation();
        $this->dispatchBrowserEvent('open-modal');
        if($this->editing->isNot($brandvehicle)) $this->editing = $brandvehicle; // para preservar cambios en los inputs
    }

    public function closeModal(){ $this->dispatchBrowserEvent('close-modal'); }
}
