<?php

namespace App\Http\Livewire\Components;

use App\Models\Notification;
use Livewire\Component;

class Notificaction extends Component
{
    public function changeStatus(Notification $notification)
    {
        $notification->status = 'visto';
        $notification->save();
    }

    public function render()
    {
        $notifications = Notification::where('status', '=', 'no visto')->get();
        return view('livewire.components.notificaction', compact('notifications'));
    }
}
