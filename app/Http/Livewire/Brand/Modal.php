<?php

namespace App\Http\Livewire\Brand;

use App\Models\BrandProduct;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Modal extends Component
{
    public $idModal = 'brandModal';
    public $nameModal;
    public BrandProduct $editing;
    protected $listeners = ['createbrand' => 'create', 'editbrand' => 'edit'];

    public function mount()
    {
        $this->editing = $this->makeBlankFields();
    }

    public function rules()
    {
        return [
            'editing.name' => ['required', 'min:3', 'max:30', Rule::unique('brand_products', 'name')->ignore($this->editing)],
        ];
    }
    protected $messages = [
        'editing.name.required' => 'El nombre es obligatorio',
        'editing.name.min' => 'El nombre debe tener al menos 3 caracteres',
        'editing.name.max' => 'El nombre no debe tener más de 30 caracteres',
        'editing.name.unique' => 'La marca ya fue registrado',
    ];

    public function save()
    {
        $this->validate();
        $this->editing->save();
        $this->emit('refreshList');
        $this->emit('refreshmodal');
        $this->nameModal === 'Crear nueva marca' ? $this->emit('success_alert', 'Marca creada') : $this->emit('success_alert', 'Marca actualizada');
        $this->dispatchBrowserEvent('close-modal-brand');
    }

    public function updated($label)
    {
        $this->validateOnly($label, $this->rules(), $this->messages);
    }

    public function makeBlankFields()
    {
        return BrandProduct::make(); /*para dejar vacios los inpust*/
    }

    public function create()
    {
        if ($this->editing->getKey()) $this->editing = $this->makeBlankFields(); // para preservar cambios en los inputs
        $this->nameModal = 'Crear nueva marca';
        $this->resetErrorBag();
        $this->resetValidation();
        $this->dispatchBrowserEvent('open-modal-brand');
    }

    public function edit(BrandProduct $brandProduct)
    {
        $this->nameModal = 'Editar marca';
        $this->resetErrorBag();
        $this->resetValidation();
        $this->dispatchBrowserEvent('open-modal-brand');
        if ($this->editing->isNot($brandProduct)) $this->editing = $brandProduct; // para preservar cambios en los inputs
    }

    public function closeModal()
    {
        $this->dispatchBrowserEvent('close-modal-brand');
    }

    public function render()
    {
        return view('livewire.brand.modal');
    }
}
