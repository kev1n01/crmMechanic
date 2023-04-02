<?php

namespace App\Http\Livewire\Vehicle;

use App\Models\TypeVehicle;
use Illuminate\Validation\Rule;
use Livewire\Component;

class TypeModal extends Component
{

    /* FOR MODAL */
    public $idModal = 'typeVehicle';
    public $nameModal;
    public TypeVehicle $editing;
    protected $listeners = ['createtype' => 'create', 'edittype' => 'edit'];

    public function mount()
    {
        $this->editing = $this->makeBlankFields();
    }
    public function rules()
    {
        return [
            'editing.name' => ['required', 'min:3', 'max:20', Rule::unique('type_vehicles', 'name')->ignore($this->editing)],
        ];
    }
    protected $messages = [
        'editing.name.required' => 'El nombre es obligatorio',
        'editing.name.min' => 'El nombre debe tener al menos 5 caracteres',
        'editing.name.max' => 'El nombre no debe tener más de 12 caracteres',
        'editing.name.unique' => 'EL tipo de vehiculo ya fue registrado',
    ];

    public function save()
    {
        $this->validate();
        $this->editing->save();
        $this->nameModal === 'Crear nuevo tipo de vehiculo ' ? $this->emit('success_alert', 'Tipo de vehiculo creada') : $this->emit('success_alert', 'Tipo de vehiculo actualizado');
        $this->emit('refreshList');
        $this->emit('resetmodal');
        $this->dispatchBrowserEvent('close-modal-type-vehicle');
    }

    public function makeBlankFields()
    {
        return TypeVehicle::make(); /*para dejar vacios los inpust*/
    }

    public function create()
    {
        if ($this->editing->getKey()) $this->editing = $this->makeBlankFields(); // para preservar cambios en los inputs
        $this->nameModal = 'Crear nuevo tipo de vehiculo ';
        $this->resetErrorBag();
        $this->resetValidation();
        $this->dispatchBrowserEvent('open-modal-type-vehicle');
    }

    public function edit(TypeVehicle $typevehicle)
    {
        $this->nameModal = 'Editar tipo de vehiculo ';
        $this->resetErrorBag();
        $this->resetValidation();
        $this->dispatchBrowserEvent('open-modal-type-vehicle');
        if ($this->editing->isNot($typevehicle)) $this->editing = $typevehicle; // para preservar cambios en los inputs
    }

    public function closeModal()
    {
        $this->dispatchBrowserEvent('close-modal-type-vehicle');
    }

    public function render()
    {
        return view('livewire.vehicle.type-modal');
    }
}
