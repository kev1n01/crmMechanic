<?php

namespace App\Http\Livewire\Product;

use App\Models\UnitProduct;
use Illuminate\Validation\Rule;
use Livewire\Component;

class UnitModal extends Component
{
    /* FOR MODAL */
    public $idModal = 'unitproductModal';
    public $nameModal;
    public UnitProduct $editing;
    protected $listeners = ['createunit' => 'create', 'editunit' => 'edit'];

    public function mount()
    {
        $this->editing = $this->makeBlankFields();
    }

    public function rules()
    {
        return [
            'editing.code' => ['required', Rule::unique('unit_products', 'code')->ignore($this->editing)],
            'editing.name' => ['required', Rule::unique('unit_products', 'name')->ignore($this->editing)],
        ];
    }

    protected $messages = [
        'editing.name.required' => 'El nombre es obligatorio',
        'editing.name.min' => 'El nombre debe tener al menos 5 caracteres',
        'editing.name.max' => 'El nombre no debe tener más de 12 caracteres',
        'editing.name.unique' => 'La unidad ya fue registrado',
        'editing.code.required' => 'El codigo es obligatorio',
        'editing.code.unique' => 'El codigo ya fue registrado',
    ];

    public function save()
    {
        $this->validate();
        $this->editing->save();
        $this->nameModal === 'Crear nueva unidad' ? $this->emit('success_alert', 'Unidad creada') : $this->emit('success_alert', 'Unidad actualizada');
        $this->emit('refreshList');
        $this->emit('refreshmodal');
        $this->dispatchBrowserEvent('close-modal-unit-product');
    }

    public function makeBlankFields()
    {
        return UnitProduct::make(); /*para dejar vacios los inpust*/
    }

    public function updated($label)
    {
        $this->validateOnly($label, $this->rules(), $this->messages);
    }

    public function create()
    {
        if ($this->editing->getKey()) $this->editing = $this->makeBlankFields(); // para preservar cambios en los inputs
        $this->nameModal = 'Crear nueva unidad';
        $this->resetErrorBag();
        $this->resetValidation();
        $this->dispatchBrowserEvent('open-modal-unit-product');
    }

    public function edit(UnitProduct $unitproduct)
    {
        $this->nameModal = 'Editar unidad';
        $this->resetErrorBag();
        $this->resetValidation();
        $this->dispatchBrowserEvent('open-modal-unit-product');
        if ($this->editing->isNot($unitproduct)) $this->editing = $unitproduct; // para preservar cambios en los inputs
    }

    public function closeModal()
    {
        $this->dispatchBrowserEvent('close-modal-unit-product');
    }

    public function render()
    {
        return view('livewire.product.unit-modal');
    }
}
