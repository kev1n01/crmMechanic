<?php

namespace App\Http\Livewire\Vehicle;

use App\Models\ColorVehicle;
use Illuminate\Validation\Rule;
use Livewire\Component;

class ColorModal extends Component
{
    public $idModal = 'colorVehicleModal';
    public $nameModal;
    public ColorVehicle $editing;
    protected $listeners = ['createcolor' => 'create', 'editcolor' => 'edit'];

    public function mount()
    {
        $this->editing = $this->makeBlankFields();
    }
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

    public function save()
    {
        $this->validate();
        $this->editing->save();
        $this->nameModal === 'Crear nuevo color' ? $this->emit('success_alert', 'Color creado') : $this->emit('success_alert', 'Color actualizada');
        $this->emit('refreshList');
        $this->dispatchBrowserEvent('close-modal-color-vehicle');
    }

    public function makeBlankFields()
    {
        return ColorVehicle::make(); /*para dejar vacios los inpust*/
    }

    public function create()
    {
        if ($this->editing->getKey()) $this->editing = $this->makeBlankFields(); // para preservar cambios en los inputs
        $this->nameModal = 'Crear nuevo color';
        $this->resetErrorBag();
        $this->resetValidation();
        $this->dispatchBrowserEvent('open-modal-color-vehicle');
    }

    public function edit(ColorVehicle $colorvehicle)
    {
        $this->nameModal = 'Editar color';
        $this->resetErrorBag();
        $this->resetValidation();
        $this->dispatchBrowserEvent('open-modal-color-vehicle');
        if ($this->editing->isNot($colorvehicle)) $this->editing = $colorvehicle; // para preservar cambios en los inputs
    }

    public function closeModal()
    {
        $this->dispatchBrowserEvent('close-modal-color-vehicle');
    }
    public function render()
    {
        return view('livewire.vehicle.color-modal');
    }
}
