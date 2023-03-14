<?php

namespace App\Http\Livewire\Vehicle;

use App\Models\BrandVehicle;
use Illuminate\Validation\Rule;
use Livewire\Component;

class BrandModal extends Component
{
    
    /* FOR MODAL */
    public $idModal = 'brandVehicleModal';
    public $nameModal;
    public BrandVehicle $editing;
    protected $listeners = ['createbrand' => 'create', 'editbrand' => 'edit'];

    public function mount()
    {
        $this->editing = $this->makeBlankFields();
    }

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

    public function save()
    {
        $this->validate();
        $this->editing->save();
        $this->nameModal === 'Crear nueva marca' ? $this->emit('success_alert', 'Marca creada') : $this->emit('success_alert', 'Marca actualizada');
        $this->emit('refreshList');
        $this->dispatchBrowserEvent('close-modal-brand-vehicle');
    }

    public function makeBlankFields()
    {
        return BrandVehicle::make(); /*para dejar vacios los inpust*/
    }

    public function create()
    {
        if ($this->editing->getKey()) $this->editing = $this->makeBlankFields(); // para preservar cambios en los inputs
        $this->nameModal = 'Crear nueva marca';
        $this->resetErrorBag();
        $this->resetValidation();
        $this->dispatchBrowserEvent('open-modal-brand-vehicle');
    }

    public function edit(BrandVehicle $brandvehicle)
    {
        $this->nameModal = 'Editar marca';
        $this->resetErrorBag();
        $this->resetValidation();
        $this->dispatchBrowserEvent('open-modal-brand-vehicle');
        if ($this->editing->isNot($brandvehicle)) $this->editing = $brandvehicle; // para preservar cambios en los inputs
    }

    public function closeModal()
    {
        $this->dispatchBrowserEvent('close-modal-brand-vehicle');
    }
    
    public function render()
    {
        return view('livewire.vehicle.brand-modal');
    }
}
