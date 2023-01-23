<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Customer;
use Livewire\Component;

class Dashboard extends Component
{
    public $customers = [];

    public function mount(){
        $this->customers = Customer::count();
    }

    public function render()
    {
        return view('livewire.dashboard.dashboard')
            ->extends('layouts.admin.app')->section('content');
    }
}
