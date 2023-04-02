<?php

namespace App\Http\Livewire\Vehicle;

use App\Models\ModelVehicle;
use Illuminate\Validation\Rule;
use Livewire\Component;

class ModelModal extends Component
{

    /* FOR MODAL */
    public $idModal = 'modelVehicleModal';
    public $nameModal;
    public ModelVehicle $editing;
    protected $listeners = ['createmodel' => 'create', 'editmodel' => 'edit'];

    public function mount()
    {
        $this->editing = $this->makeBlankFields();
    }

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

    public function save()
    {
        $this->validate();
        $this->editing->save();
        $this->nameModal === 'Crear nueva modelo' ? $this->emit('success_alert', 'Modelo creado') : $this->emit('success_alert', 'Modelo actualizado');
        $this->emit('refreshList');
        $this->emit('resetmodal');
        $this->dispatchBrowserEvent('close-modal-model-vehicle');
    }

    public function makeBlankFields()
    {
        return ModelVehicle::make(); /*para dejar vacios los inpust*/
    }

    public function create()
    {
        if ($this->editing->getKey()) $this->editing = $this->makeBlankFields(); // para preservar cambios en los inputs
        $this->nameModal = 'Crear nuevo modelo';
        $this->resetErrorBag();
        $this->resetValidation();
        $this->dispatchBrowserEvent('open-modal-model-vehicle');
    }

    public function edit(ModelVehicle $modelvehicle)
    {
        $this->nameModal = 'Editar modelo';
        $this->resetErrorBag();
        $this->resetValidation();
        $this->dispatchBrowserEvent('open-modal-model-vehicle');
        if ($this->editing->isNot($modelvehicle)) $this->editing = $modelvehicle; // para preservar cambios en los inputs
    }

    public function closeModal()
    {
        $this->dispatchBrowserEvent('close-modal-model-vehicle');
    }
    public function render()
    {
        return view('livewire.vehicle.model-modal');
    }
}
