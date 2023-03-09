<?php

namespace App\Http\Livewire\Vehicle;

use App\Models\ColorVehicle;
use App\Traits\DataTable;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Livewire\Component;

class ColorVehicleTable extends Component
{
    use DataTable;

    public $showFilters = false;
    public $selected = [];
    public $selectedPage = false;

    protected $listeners = ['delete', 'deleteSelected', 'exportSelected', 'refreshList' => '$refresh'];

    protected $queryString = ['search'=> ['except' => '']];  

    public $filters = ['fromDate' => null, 'toDate' => null];

    public function mount(){ $this->sortField = 'id'; $this->editing = $this->makeBlankFields(); } 

    public function showFilter(){ $this->showFilters = $this->showFilters ? false : true; }

    public function updatedFilters()
    {
        $this->resetPage();
    }

    public function updatedSelectedPage($value)
    {
        $this->selected = $value ? $this->colors->pluck('id')->map(fn ($id) => (string) $id) : [];
    }

    public function getColorsProperty()
    {
        return ColorVehicle::query()
            ->when($this->filters['fromDate'] && $this->filters['toDate'], fn ($q, $created_at) => 
                $q->whereBetween('created_at', [Carbon::parse($this->filters['fromDate'])->format('Y-m-d') . ' 00:00:00', Carbon::parse($this->filters['toDate'])->format('Y-m-d') . ' 23:59:00']))            ->search('name', $this->search)
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);
    }

    public function render()
    {
        // sleep(0.5); //se toma 2 seg para renderizar
        return view('livewire.vehicle.color-vehicle-table',[
            'colors' => $this->colors,
            ])->extends('layouts.admin.app')->section('content');
    }
   
    public function resetFilters()
    {
        $this->reset('filters');
    }

    public function delete(ColorVehicle $colorvehicle){ $colorvehicle->delete(); }

    public function exportSelected()
    {
        return response()->streamDownload(function () {
            echo ColorVehicle::whereKey($this->selected)->toCsv();
        }, 'color_vehiculo.csv');
        $this->selected = [];
        $this->emit('success_alert', 'Se exportaron los registros seleccionados');
    }

    public function deleteSelected()
    {
        $colors = ColorVehicle::whereKey($this->selected);
        $colors->delete();
        $this->selected = [];
        $this->emit('success_alert', count($this->selected) . ' registros eliminados');
    }

    /* FOR MODAL */
    public $idModal = 'colorVehicleModal';
    public $nameModal ;
    public ColorVehicle $editing;
        
    public function rules()
    {
        return [
            'editing.name' => ['required', 'min:3', 'max:12', Rule::unique('color_vehicles', 'name')->ignore($this->editing)],
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
        $this->nameModal === 'Crear nuevo color' ? $this->emit('success_alert','Color creado') : $this->emit('success_alert','Color actualizada');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function makeBlankFields(){ return ColorVehicle::make(); /*para dejar vacios los inpust*/ }
    
    public function create(){
        if($this->editing->getKey()) $this->editing = $this->makeBlankFields(); // para preservar cambios en los inputs
        $this->nameModal = 'Crear nuevo color';
        $this->resetErrorBag();
        $this->resetValidation();
        $this->dispatchBrowserEvent('open-modal');
    }

    public function edit(ColorVehicle $colorvehicle){
        $this->nameModal = 'Editar color';
        $this->resetErrorBag();
        $this->resetValidation();
        $this->dispatchBrowserEvent('open-modal');
        if($this->editing->isNot($colorvehicle)) $this->editing = $colorvehicle; // para preservar cambios en los inputs
    }

    public function closeModal(){ $this->dispatchBrowserEvent('close-modal'); }
}
