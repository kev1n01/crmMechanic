<?php

namespace App\Http\Livewire\Setting;

use App\Models\Sunat;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class SunatConf extends Component
{
    use WithFileUploads;
    public Sunat $editing;
    public $certificate;

    public function mount()
    {
        $sunat_exist = Sunat::first() == null ? false : true;
        if ($sunat_exist) {
            $this->editing = Sunat::first();
        } else {
            $this->editing = $this->makeBlankFields();
        }
    }

    public function rules()
    {
        return [
            'editing.ruc' => ['required', 'min:11', 'max:11'],
            'editing.social_reason' => 'required',
            'editing.address' => ['required'],
            'editing.user_sol_secondary' => 'required',
            'editing.password_sol_secondary' => 'required',
            'editing.certificate' => ['nullable'],
            'editing.certificate_password' => ['required'],
        ];
    }

    protected $messages = [
        'editing.ruc.min' => 'El ruc no debe tener menos de 11 caracteres',
        'editing.ruc.max' => 'El ruc no debe tener menos de 11 caracteres',
        'editing.ruc.required' => 'El ruc es obligatorio',
        'editing.social_reason.required' => 'La razón social es obligatoria',
        'editing.address.required' => 'La dirección es obligatoria',
        'editing.user_sol_secondary.required' => 'El usuario es obligatorio',
        'editing.password_sol_secondary.required' => 'La contraseña es obligatoria',
        'editing.certificate_password.required' => 'La contraseña del certificado es obligatoria',
    ];

    public function updatingCertificate($value)
    {
        Validator::make(
            ['certificate' => $value],
            ['certificate' => 'max:1024'],
            [
                'certificate.max' => 'El tamaño máximo del certificado es 1MB',
            ]
        )->validate();
    }

    public function updated($label)
    {
        $this->validateOnly($label, $this->rules(), $this->messages);
    }

    public function loadCertificate(TemporaryUploadedFile $certificate)
    {
        return Storage::disk('public')->put('Sunat', $certificate);
    }

    public function removeCertificate($certificate)
    {
        if ($certificate === '' || $certificate == null) return;
        if (Storage::disk('public')->exists($certificate)) {
            Storage::disk('public')->delete($certificate);
        }
    }

    public function makeBlankFields()
    {
        return Sunat::make(); /*para dejar vacios los inpust*/
    }

    public function save()
    {
        $this->validate();

        if ($this->editing->certificate != null) {
            $this->removeCertificate($this->editing->certificate);
        }

        if ($this->certificate) {
            $this->editing->certificate = $this->loadCertificate($this->certificate);
        }

        $this->editing->save();
        $this->emit('success_alert', 'Configuración de sunat guardada con éxito');
    }
    public function render()
    {
        return view('livewire.setting.sunat-conf');
    }
}
