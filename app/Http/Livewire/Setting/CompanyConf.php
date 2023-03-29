<?php

namespace App\Http\Livewire\Setting;

use App\Models\Company;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class CompanyConf extends Component
{
    use WithFileUploads;
    public Company $editing;
    public $logo;

    public function mount()
    {
        $company_exist = Company::first() == null ? false : true;
        if ($company_exist) {
            $this->editing = Company::first();
        } else {
            $this->editing = $this->makeBlankFields();
        }
    }

    public function rules()
    {
        return [
            'editing.name' => ['required', 'min:5'],
            'editing.phone' => 'required|min:9|max:9',
            'editing.ubigeous' => 'required|min:6|max:6',
            'editing.address' => 'required',
            'editing.logo' => ['nullable'],
            'editing.department' => 'required|in:' . collect(Company::DEPARTMENTS)->keys()->implode(','),
            'editing.province' => 'required|in:' . collect(Company::PROVINCES)->keys()->implode(','),
            'editing.district' => 'required|in:' . collect(Company::DISTRICTS)->keys()->implode(','),
            'logo' => 'required'
        ];
    }

    protected $messages = [
        'editing.name.min' => 'El nombre no debe tener menos de 5 caracteres',
        'editing.name.required' => 'El nombre es obligatorio',
        'editing.phone.required' => 'El telefono es obligatorio',
        'editing.phone.min' => 'El telefono no debe tener menos de 9 caracteres',
        'editing.phone.max' => 'El telefono no debe tener más de 9 caracteres',
        'editing.ubigeous.required' => 'El ubigeo es obligatorio',
        'editing.ubigeous.min' => 'El ubigeo no debe tener menos de 6 caracteres',
        'editing.ubigeous.max' => 'El ubigeo no debe tener más de 6 caracteres',
        'editing.address.required' => 'La dirección es obligatorio',
        'editing.department.required' => 'El departamento es obligatorio',
        'editing.department.in' => 'El valor es inválido',
        'editing.province.required' => 'El provincia es obligatorio',
        'editing.province.in' => 'El valor es inválido',
        'editing.province.required' => 'El distrito es obligatorio',
        'editing.province.in' => 'El valor es inválido',
        'logo.required' => 'El logo es obligatorio',
    ];

    public function updatingLogo($value)
    {
        Validator::make(
            ['logo' => $value],
            ['logo' => 'mimes:png|max:1024'],
            [
                'logo.mimes' => 'Solo se permite imagenes de tipo png',
                'logo.max' => 'El tamaño máximo de la imagen es 1MB',
            ]
        )->validate();
    }

    public function updated($label)
    {
        $this->validateOnly($label, $this->rules(), $this->messages);
    }

    public function loadLogo(TemporaryUploadedFile $logo)
    {
        return Storage::disk('public')->put('Company', $logo);
    }

    public function removeLogo($logo)
    {
        if (!$logo) return;
        if (Storage::disk('public')->exists($logo)) {
            Storage::disk('public')->delete($logo);
        }
    }

    public function makeBlankFields()
    {
        return Company::make(); /*para dejar vacios los inpust*/
    }

    public function save()
    {
        $this->validate();

        if ($this->editing->logo != null) {
            $this->removeLogo($this->editing->logo);
        }

        if ($this->logo) {
            $this->editing->logo = $this->loadLogo($this->logo);
        }

        $this->editing->save();
        $this->emit('success_alert', 'Configuración de empresa guardada con éxito');
    }

    public function render()
    {
        return view('livewire.setting.company-conf')
            ->extends('layouts.admin.app')
            ->section('content');
    }
}
