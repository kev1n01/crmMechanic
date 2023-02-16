<?php

namespace App\Http\Livewire\Vehicle;

use App\Models\BrandVehicle;
use App\Models\ColorVehicle;
use App\Models\Customer;
use App\Models\ModelVehicle;
use App\Models\TypeVehicle;
use App\Models\Vehicle;
use App\Traits\DataTable;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class VehicleTable extends Component
{
    use DataTable;
    use WithFileUploads;
    public $showFilters = false;
    public $selected = [];
    public $selectedPage = false;
    /* FOR MODAL */
    public $idModal = 'vehicleModal';
    public $modalsize = 'modal-lg';
    public $nameModal;
    public Vehicle $editing;
    public $image;

    public $filters = [
        'fromDate' => null,
        'toDate' => null,
        'customer' => '',
        'model_year' => '',
        'type' => '',
        'brand' => '',
        'model' => '',
        'color' => ''
    ];

    protected $listeners = ['delete', 'deleteSelected', 'refreshList' => '$refresh'];

    protected $queryString = ['search' => ['except' => '']];

    public function mount()
    {
        $this->sortField = 'license_plate';
        $this->editing = $this->makeBlankFields();
        $this->customers = Customer::pluck('name', 'id');
        $this->years = Vehicle::YEARS;
        $this->types = TypeVehicle::pluck('name', 'id');
        $this->brands = BrandVehicle::pluck('name', 'id');
        $this->models = ModelVehicle::pluck('name', 'id');
        $this->colors = ColorVehicle::pluck('name', 'id');
    }

    public function updatedFilters()
    {
        $this->resetPage();
    }

    public function updatedSelectedPage($value)
    {
        $this->selected = $value ? $this->vehicles->pluck('id')->map(fn ($id) => (string) $id) : [];
    }

    public function resetFilters()
    {
        $this->reset('filters');
    }

    public function showFilter()
    {
        $this->showFilters = $this->showFilters ? false : true;
    }

    public function getVehiclesProperty()
    {
        return Vehicle::query()
            ->when($this->search, fn ($q, $search) => $q->where('license_plate', 'like', '%' . $search . '%')
                ->orWhere('model_year', 'like', '%' . $search . '%')->orWhere('odo', 'like', '%' . $search . '%'))
            ->when($this->filters['fromDate'] && $this->filters['toDate'], fn ($q, $created_at) =>
            $q->whereBetween('created_at', [Carbon::parse($this->filters['fromDate'])->format('Y-m-d') . ' 00:00:00', Carbon::parse($this->filters['toDate'])->format('Y-m-d') . ' 23:59:00']))
            ->when($this->filters['customer'], fn ($q, $customer) => $q->where('customer_id', $customer))
            ->when($this->filters['model_year'], fn ($q, $model_year) => $q->where('model_year', $model_year))
            ->when($this->filters['type'], fn ($q, $type) => $q->where('type_vehicle', $type))
            ->when($this->filters['brand'], fn ($q, $brand) => $q->where('brand_vehicle', $brand))
            ->when($this->filters['model'], fn ($q, $model) => $q->where('model_vehicle', $model))
            ->when($this->filters['color'], fn ($q, $color) => $q->where('color_vehicle', $color))
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);
    }

    public function render()
    {
        sleep(0.5); //se toma 2 seg para renderizar
        return view('livewire.vehicle.vehicle-table', [
            'vehicles' => $this->vehicles,
        ])->extends('layouts.admin.app')->section('content');
    }

    public function delete(Vehicle $vehicle)
    {
        $this->removeImage($vehicle->image);
        $vehicle->delete();
    }

    public function exportSelected()
    {
        return response()->streamDownload(function () {
            echo Vehicle::whereKey($this->selected)->toCsv();
        }, 'vehicles.csv');
        $this->emit('success_alert', 'Se exportaron los registros seleccionados');
    }

    public function deleteSelected()
    {
        $vehicle = Vehicle::whereKey($this->selected);
        $vehiclefind = Vehicle::find($this->selected);
        foreach ($vehiclefind as $pf) {
            $this->removeImage($pf['image']);
        }
        $vehicle->delete();
        $this->emit('success_alert', count($this->selected) . ' registros eliminados');
    }

    /* FOR MODAL */
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
        $this->dispatchBrowserEvent('close-modal');
        $this->emit('refreshList');
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
        $this->resetErrorBag();
        $this->resetValidation();
        $this->image = '';
        $this->nameModal = 'Registrar nuevo vehiculo';
        if ($this->editing->getKey()) $this->editing = $this->makeBlankFields(); // para preservar cambios en los inputs
        $this->dispatchBrowserEvent('open-modal');
    }

    public function edit(Vehicle $vehicle)
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->image = '';
        $this->nameModal = 'Editar vehiculo';
        if ($this->editing->isNot($vehicle)) $this->editing = $vehicle; // para preservar cambios en los inputs
        $this->dispatchBrowserEvent('open-modal');
    }

    public function closeModal()
    {
        $this->dispatchBrowserEvent('close-modal');
    }
}
