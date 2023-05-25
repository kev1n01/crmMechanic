<?php

namespace App\Http\Livewire\Reminder;

use App\Models\Notification;
use App\Models\Reminder;
use App\Models\Vehicle;
use App\Traits\DataTable;
use Carbon\Carbon;
use Livewire\Component;

class ReminderTable extends Component
{
    use DataTable;

    public $showFilters = false;
    public $selected = [];
    public $selectedPage = false;
    /* FOR MODAL */
    public $idModal = 'reminderModal';
    public $nameModal;
    public Reminder $editing;

    public $vehicles = [];
    public $statuses = [];
    public $customername = '';

    public $filters = [
        'fromDate' => null,
        'toDate' => null,
        'status' => null,
        'vehicle_id' => null,
    ];

    protected $listeners = ['delete', 'deleteSelected', 'refreshList' => '$refresh'];

    protected $queryString = ['search' => ['except' => '']];

    public function mount()
    {
        $this->search = '';
        $this->sortField = 'description';
        $this->vehicles = Vehicle::pluck('license_plate', 'id');
        $this->statuses = Reminder::STATUSES;
        $this->editing = $this->makeBlankFields();
    }

    public function updatedEditingVehicleId()
    {
        $this->customername = $this->editing->vehicle->customer->name;
    }

    public function updatedFilters()
    {
        $this->resetPage();
    }

    public function updatedSelectedPage($value)
    {
        $this->selected = $value ? $this->reminders->pluck('id')->map(fn ($id) => (string) $id) : [];
    }

    public function resetFilters()
    {
        $this->reset('filters');
    }

    public function showFilter()
    {
        $this->showFilters = $this->showFilters ? false : true;
    }

    public function getRemindersProperty()
    {
        return Reminder::query()
            ->when($this->filters['fromDate'] && $this->filters['toDate'], fn ($q, $created_at) => $q->whereBetween('date', [Carbon::parse($this->filters['fromDate'])->format('Y-m-d') . ' 00:00:00', Carbon::parse($this->filters['toDate'])->format('Y-m-d') . ' 23:59:00']))
            ->when($this->search, fn ($q, $search) => $q->where('description', 'like', '%' . $search . '%'))
            ->when($this->filters['status'], fn ($q, $status) => $q->where('status', $status))
            ->when($this->filters['vehicle_id'], fn ($q, $vehicle_id) => $q->where('vehicle_id', $vehicle_id))
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);
    }

    public function render()
    {
        sleep(0.5); //se toma 2 seg para renderizar
        return view('livewire.reminder.reminder-table', [
            'reminders' => $this->reminders,
        ])
            ->extends('layouts.admin.app')
            ->section('content');
    }

    public function delete(Reminder $reminder)
    {
        $reminder->delete();
    }

    public function exportSelected()
    {
        return response()->streamDownload(function () {
            echo Reminder::whereKey($this->selected)->toCsv();
        }, 'informes.csv');
        $this->emit('success_alert', 'Se exportaron los registros seleccionados');
    }

    public function deleteSelected()
    {
        $reminders = Reminder::whereKey($this->selected);
        $reminders->delete();
        $this->emit('success_alert', count($this->selected) . ' registros eliminados');
    }

    /* FOR MODAL */
    public function rules()
    {
        return [
            'editing.description' => ['required', 'min:5'],
            'editing.vehicle_id' => ['required'],
            'editing.date' => ['required'],
            'editing.status' => ['required'],
        ];
    }

    protected $messages = [
        'editing.description.required' => 'La descripción es obligatorio',
        'editing.description.min' => 'La descripción debe tener al menos 5 caracteres',
        'editing.vehicle_id.required' => 'El vehiculo es obligatorio',
        'editing.date.required' => 'La fecha es obligatorio',
        'editing.status.required' => 'El estado es obligatorio',
    ];

    public function save()
    {
        $this->validate();
        $this->editing->date = Carbon::parse($this->editing->date)->format('Y-m-d');
        $this->editing->save();
        $this->nameModal === 'Registrar nuevo informe' ? $this->emit('success_alert', 'informe registrado') : $this->emit('success_alert', 'informe actualizado');
        $this->dispatchBrowserEvent('close-modal-reminder');
        $this->emit('refreshList');
    }

    public function updated($label)
    {
        $this->validateOnly($label, $this->rules(), $this->messages);
    }

    public function makeBlankFields()
    {
        return Reminder::make(['date' => Carbon::now()->format('d-m-Y'), 'status' => 'no enviado']); /*para dejar vacios los inpust*/
    }

    public function create()
    {
        if ($this->editing->getKey()) {
            $this->editing = $this->makeBlankFields();
        } // para preservar cambios en los inputs
        $this->nameModal = 'Registrar nuevo informe';
        $this->resetErrorBag();
        $this->resetValidation();
        $this->dispatchBrowserEvent('open-modal-reminder');
    }

    public function edit(Reminder $reminder)
    {
        $this->nameModal = 'Editar informe';
        $this->resetErrorBag();
        $this->resetValidation();
        $this->dispatchBrowserEvent('open-modal-reminder');
        if ($this->editing->isNot($reminder)) {
            $this->editing = $reminder;
            $this->editing->date = Carbon::parse($reminder->date)->format('d-m-Y');
            $this->customername = $reminder->vehicle->customer->name;
        } // para preservar cambios en los inputs
    }

    public function closeModal()
    {
        $this->dispatchBrowserEvent('close-modal-reminder');
    }

    public function changeStatus(Reminder $rm)
    {
        $rm->status = 'enviado';
        $rm->save();
    }
    public function addNotificationReminderExpired(Reminder $rm)
    {
        $nt = Notification::make();
        if ($nt->where('title', $rm->vehicle->license_plate . ' - ' . $rm->vehicle->customer->name)->exists()) {
            return;
        } else {
            $nt->title = $rm->vehicle->license_plate . ' - ' . $rm->vehicle->customer->name;
            $nt->expire_time = Carbon::parse($rm->date)->diffForHumans();
            $nt->status = 'no visto';
            $nt->save();
        }
    }
}
