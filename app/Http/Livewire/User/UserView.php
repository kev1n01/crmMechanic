<?php

namespace App\Http\Livewire\User;

use Livewire\Component;

class UserView extends Component
{
    public function render()
    {
        return view('livewire.user.user-view')->layout('layouts.app');
    }
}
