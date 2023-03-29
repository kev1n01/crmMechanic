<?php

namespace App\Http\Livewire\DuePay;

use App\Models\DuePay;
use App\Models\Sale;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Modal extends Component
{
    /* FOR MODAL */
    public $idModal = 'dueModal';
    public $nameModal;
    public $pay_from_sale = false;
    public $reasons = [];
    protected $listeners = ['createDuepay' => 'create', 'editDuepay' => 'edit', 'payDuepay' => 'pay'];
    public DuePay $editing;

    public function mount()
    {
        $this->reasons = DuePay::REASONS;
        $this->editing = $this->makeBlankFields();
    }

    public function rules()
    {
        return [
            'editing.description' => ['required', Rule::unique('due_pays', 'description')->ignore($this->editing)],
            'editing.person_owed' => ['required'],
            'editing.amount_owed' => ['required'],
            'editing.amount_paid' => ['required'],
            'editing.reason' => 'required|in:' . collect(DuePay::REASONS)->keys()->implode(',')
        ];
    }

    protected $messages = [
        'editing.description.required' => 'La descripcion es obligatorio',
        'editing.description.unique' => 'La descripcion ya fue registrado ',
        'editing.person_owed.required' => 'El nombre del deudor es obligatorio',
        'editing.amount_owed.required' => 'El monto adeudado es obligatorio',
        'editing.amount_paid.required' => 'El monto pagado es obligatorio',
        'editing.reason.required' => 'La razon es obligatorio',
        'editing.reason.in' => 'El valor es invalido',
    ];

    public function save()
    {
        $this->validate();
        $sale = Sale::where('code_sale', $this->editing->description)->first();
        if ($this->editing->amount_paid >= $this->editing->amount_owed) {
            $sale->status = 'pagado';
            if ($sale->type_sale == 'vehicular') {
                $sale->cash = $sale->total;
            } else {
                $sale->cash = $this->editing->amount_paid;
            }
            $sale->save();
            $this->editing->delete();
        }
        if ($this->editing->amount_paid < $this->editing->amount_owed) {
            if ($this->editing->amount_paid >= $sale->total) {
                $sale->status = 'pagado';
                $sale->cash = $sale->total;
            }
            if ($this->editing->amount_paid < $sale->total) {
                $sale->status = 'no pagado';
                $sale->cash = $this->editing->amount_paid;
            }
            $sale->save();
            $this->editing->save();
        }
        $this->nameModal === 'Crear deuda por cobrar' ? $this->emit('success_alert', 'Deuda por cobrar creada') : $this->emit('success_alert', 'Deuda por cobrar actualizada');
        $this->dispatchBrowserEvent('close-modal-duepay');
        $this->emit('refreshList');
    }

    public function updated($label)
    {
        $this->validateOnly($label, $this->rules(), $this->messages);
    }

    public function makeBlankFields()
    {
        return DuePay::make(['amount_owed' => 0, 'amount_paid' => 0, 'reason' => 'otro']); /*para dejar vacios los inpust*/
    }

    public function create()
    {
        if ($this->editing->getKey()) $this->editing = $this->makeBlankFields(); // para preservar cambios en los inputs
        $this->nameModal = 'Crear nueva deuda por cobrar';
        $this->resetErrorBag();
        $this->resetValidation();
        $this->dispatchBrowserEvent('open-modal-duepay');
    }

    public function edit(DuePay $due)
    {
        $this->nameModal = 'Editar o pagar deuda por cobrar';
        $this->resetErrorBag();
        $this->resetValidation();
        $this->dispatchBrowserEvent('open-modal-duepay');
        if ($this->editing->isNot($due)) $this->editing = $due; // para preservar cambios en los inputs
    }

    public function pay($code)
    {
        $due = DuePay::where('description', 'like', '%' . $code . '%')->first();
        $this->nameModal = 'Pagar deuda';
        $this->pay_from_sale = true;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('open-modal-duepay');
        if ($this->editing->isNot($due)) $this->editing = $due; // para preservar cambios en los inputs
    }

    public function closeModal()
    {
        $this->dispatchBrowserEvent('close-modal-duepay');
    }

    public function render()
    {
        return view('livewire.due-pay.modal');
    }
}
