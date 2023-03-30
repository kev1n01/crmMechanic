<?php

namespace App\Http\Livewire\Vehicle;

use App\Models\BrandVehicle;
use App\Models\ColorVehicle;
use App\Models\Customer;
use App\Models\ModelVehicle;
use App\Models\TypeVehicle;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class Modal extends Component
{
    use WithFileUploads;

    public $idModal = 'vehicleModal';
    public $modalsize = 'modal-lg';
    public $nameModal;
    public Vehicle $editing;
    public $image;

    public $customers = [];
    public $years = [];
    public $types = [];
    public $brands = [];
    public $models = [];
    public $colors = [];
    protected $listeners = ['createvehicle' => 'create', 'editvehicle' => 'edit'];

    public function mount()
    {
        $this->editing = $this->makeBlankFields();
        $this->customers = Customer::pluck('name', 'id');
        $this->years = Vehicle::YEARS;
        $this->types = TypeVehicle::pluck('name', 'id');
        $this->brands = BrandVehicle::pluck('name', 'id');
        $this->models = ModelVehicle::pluck('name', 'id');
        $this->colors = ColorVehicle::pluck('name', 'id');
    }

    public function rules()
    {
        return [
            'editing.license_plate' => ['required', 'min:7', 'max:7', Rule::unique('vehicles', 'license_plate')->ignore($this->editing)],
            'editing.customer_id' => 'required',
            'editing.type_vehicle' => 'required',
            'editing.brand_vehicle' => 'required',
            'editing.model_vehicle' => 'required',
            'editing.color_vehicle' => 'required',
            'editing.model_year' => 'in:' . collect(Vehicle::YEARS)->keys()->implode(','),
            'editing.odo' => 'required',
            'editing.image' => 'nullable',
            'editing.description' => 'nullable',
        ];
    }

    protected $messages = [
        'editing.license_plate.min' => 'La placa no debe tener menos de 7caracteres',
        'editing.license_plate.max' => 'La placa no debe tener más de 7 caracteres',
        'editing.license_plate.required' => 'La placa es obligatorio',
        'editing.license_plate.unique' => 'Ya existe un vehiculo con esta placa',
        'editing.customer_id.required' => 'El cliente es obligatorio',
        'editing.type_vehicle.required' => 'El tipo es obligatorio',
        'editing.brand_vehicle.required' => 'La marca es obligatorio',
        'editing.model_vehicle.required' => 'El modelo es obligatorio',
        'editing.color_vehicle.required' => 'EL color es obligatorio',
        'editing.model_year.in' => 'El valor es inválido',
        'editing.odo.required' => 'EL kilometraje es obligatorio',
    ];

    public function updatingImage($value)
    {
        Validator::make(
            ['image' => $value],
            ['image' => 'mimes:jpg,jpeg,png|max:1024'],
            [
                'image.mimes' => 'Solo se permite imagenes de tipo jpg, jpeg, png',
                'image.max' => 'El tamaño máximo de la imagen es 1MB',
            ]
        )->validate();
    }

    public function updated($label)
    {
        $this->validateOnly($label, $this->rules(), $this->messages);
    }

    public function save()
    {
        $this->validate();

        if ($this->editing->image != null) {
            $this->removeImage($this->editing->image);
        }

        if ($this->image) {
            $this->editing->image = $this->loadImage($this->image);
        }

        $this->editing->save();
        $this->nameModal === 'Registrar nuevo vehiculo' ? $this->emit('success_alert', 'Vehiculo registrado') : $this->emit('success_alert', 'Vehiculo actualizado');
        $this->dispatchBrowserEvent('close-modal-vehicle');
        $this->emit('refreshList');
        $this->emit('refreshListModals');
    }

    public function loadImage(TemporaryUploadedFile $image)
    {
        return Storage::disk('public')->put('vehiculos', $image);
    }

    public function removeImage($image)
    {
        if (!$image) return;
        if (Storage::disk('public')->exists($image)) {
            Storage::disk('public')->delete($image);
        }
    }

    public function makeBlankFields()
    {
        return Vehicle::make(); /*para dejar vacios los inpust*/
    }

    public function create()
    {
        $this->customers = Customer::where('status', 'activo')->pluck('name', 'id');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->image = '';
        $this->nameModal = 'Registrar nuevo vehiculo';
        if ($this->editing->getKey()) $this->editing = $this->makeBlankFields(); // para preservar cambios en los inputs
        $this->dispatchBrowserEvent('open-modal-vehicle');
    }

    public function edit(Vehicle $vehicle)
    {
        // dd($vehicle);
        $this->resetErrorBag();
        $this->resetValidation();
        $this->image = '';
        $this->nameModal = 'Editar vehiculo';
        if ($this->editing->isNot($vehicle)) $this->editing = $vehicle; // para preservar cambios en los inputs
        $this->dispatchBrowserEvent('open-modal-vehicle');
    }

    public function closeModal()
    {
        $this->dispatchBrowserEvent('close-modal-vehicle');
    }

    public function render()
    {
        return view('livewire.vehicle.modal');
    }
}
