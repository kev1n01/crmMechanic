<?php

namespace App\Http\Livewire\Brand;

use App\Models\BrandProduct;
use App\Traits\DataTable;
use Illuminate\Validation\Rule;
use Livewire\Component;

class BrandTable extends Component
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
        return view('livewire.brand.brand-table',[
            'brands' => BrandProduct::query()
            ->when($this->filters['fromDate'] && $this->filters['toDate'],fn($q) => $q->whereBetween('created_at',[$this->filters['fromDate'].' 00:00:00',$this->filters['toDate'].' 23:59:00']))
            ->search('name', $this->search)
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage),
            ])->extends('layouts.admin.app')->section('content');
    }
   
    public function delete(BrandProduct $brandProduct){ $brandProduct->delete(); }

    /* FOR MODAL */
    public $idModal = 'brandModal';
    public $nameModal ;
    public BrandProduct $editing;
        
    public function rules()
    {
        return [
            'editing.name' => ['required', 'min:5', 'max:12', Rule::unique('brand_products', 'name')->ignore($this->editing)],
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

    public function makeBlankFields(){ return BrandProduct::make(); /*para dejar vacios los inpust*/ }
    
    public function create(){
        if($this->editing->getKey()) $this->editing = $this->makeBlankFields(); // para preservar cambios en los inputs
        $this->nameModal = 'Crear nueva marca';
        $this->resetErrorBag();
        $this->resetValidation();
        $this->dispatchBrowserEvent('open-modal');
    }

    public function edit(BrandProduct $brandProduct){
        $this->nameModal = 'Editar marca';
        $this->resetErrorBag();
        $this->resetValidation();
        $this->dispatchBrowserEvent('open-modal');
        if($this->editing->isNot($brandProduct)) $this->editing = $brandProduct; // para preservar cambios en los inputs
    }

    public function closeModal(){ $this->dispatchBrowserEvent('close-modal'); }
}
