<?php

namespace App\Http\Livewire\Category;

use App\Models\CategoryProduct;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Modal extends Component
{
    public $idModal = 'categoryModal';
    public $nameModal ;
    public CategoryProduct $editing;
    
    protected $listeners = ['create','edit'];

    public function rules()
    {
        return [
            'editing.name' => ['required', 'min:5', 'max:12', Rule::unique('category_products', 'name')->ignore($this->editing)],
        ];
    }
    
    protected $messages = [
        'editing.name.required' => 'El nombre es obligatorio',
        'editing.name.min' => 'El nombre debe tener al menos 5 caracteres',
        'editing.name.max' => 'El nombre no debe tener más de 12 caracteres',
        'editing.name.unique' => 'La categoría ya está registrado',
    ];
    
    public function mount(){ $this->editing = $this->makeBlankFields();}

    public function save(){
        $this->validate();
        $this->editing->save();
        $this->emit('refreshList');
        $this->nameModal === 'Crear nueva categoria' ? $this->emit('success_alert','Categoría creada') : $this->emit('success_alert','categoría actualizada');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function makeBlankFields(){ return CategoryProduct::make(); /*para dejar vacios los inpust*/ }
    
    public function create(){
        if($this->editing->getKey()) $this->editing = $this->makeBlankFields(); // para preservar cambios en los inputs
        $this->nameModal = 'Crear nueva categoria';
        $this->resetErrorBag();
        $this->resetValidation();
        $this->dispatchBrowserEvent('open-modal');
    }

    public function edit(CategoryProduct $categoryProduct){
        $this->nameModal = 'Editar categoria';
        $this->resetErrorBag();
        $this->resetValidation();
        $this->dispatchBrowserEvent('open-modal');
        if($this->editing->isNot($categoryProduct)) $this->editing = $categoryProduct; // para preservar cambios en los inputs
    }

    public function closeModal(){ $this->dispatchBrowserEvent('close-modal');}

    public function render(){ return view('livewire.category.modal'); } 
}
