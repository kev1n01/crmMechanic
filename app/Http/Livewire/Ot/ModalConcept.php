<?php

namespace App\Http\Livewire\Ot;

use App\Models\Concept;
use Illuminate\Validation\Rule;
use Livewire\Component;

class ModalConcept extends Component
{

    public $idModal = 'conceptModal';
    public $nameModal;
    public Concept $editingconcept;
    protected $listeners = ['editconcept' => 'edit', 'createconcept' => 'create'];

    public function code_random()
    {
        $cc = Concept::count();
        return $cc + 1;
    }

    public function mount()
    {
        $this->editingconcept = $this->makeBlankFields();
        $this->editingconcept->code = $this->code_random();
    }

    public function rules()
    {
        return [
            'editingconcept.name' => ['required', 'min:5', 'max:50', Rule::unique('concepts', 'name')->ignore($this->editingconcept)],
            'editingconcept.code' => ['required', 'min:1', 'max:3', Rule::unique('concepts', 'code')->ignore($this->editingconcept)],
            'editingconcept.price' => 'required|numeric|regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/',
        ];
    }
    protected $messages = [
        'editingconcept.name.required' => 'El nombre es obligatorio',
        'editingconcept.name.min' => 'El nombre debe tener al menos 5 caracteres',
        'editingconcept.name.max' => 'El nombre no debe tener más de 50 caracteres',
        'editingconcept.name.unique' => 'El servicio ya fue registrado',
        'editingconcept.code.required' => 'El codigo es obligatorio',
        'editingconcept.code.min' => 'El codigo debe tener al menos 1 caracteres',
        'editingconcept.code.max' => 'El codigo no debe tener más de 3 caracteres',
        'editingconcept.code.unique' => 'El codigo ya fue registrado',
        'editingconcept.price.required' => 'El precio es obligatorio',
    ];

    public function save()
    {
        $this->validate();
        $this->editingconcept->save();
        $this->nameModal === 'Crear nuevo servicio' ? $this->emit('success_alert', 'Servicio creado') : $this->emit('success_alert', 'Servicio actualizado');
        $this->dispatchBrowserEvent('close-modal-concept');
        $this->emit('refreshList');
        $this->emit('refreshListModals');
    }

    public function makeBlankFields()
    {
        return Concept::make(['price' => 0]); /*para dejar vacios los inpust*/
    }

    public function updated($label)
    {
        $this->validateOnly($label, $this->rules(), $this->messages);
    }

    public function create()
    {
        if ($this->editingconcept->getKey()) $this->editingconcept = $this->makeBlankFields(); // para preservar cambios en los inputs
        $this->editingconcept->code = $this->code_random();
        $this->nameModal = 'Crear nuevo servicio';
        $this->resetErrorBag();
        $this->resetValidation();
        $this->dispatchBrowserEvent('open-modal-concept');
    }

    public function edit(Concept $concept)
    {
        $this->nameModal = 'Editar servicio';
        $this->resetErrorBag();
        $this->resetValidation();
        $this->dispatchBrowserEvent('open-modal-concept');
        if ($this->editingconcept->isNot($concept)) $this->editingconcept = $concept; // para preservar cambios en los inputs
    }

    public function closeModal()
    {
        $this->dispatchBrowserEvent('close-modal-concept');
    }
    public function render()
    {
        return view('livewire.ot.modal-concept');
    }
}
