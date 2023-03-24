<?php

namespace App\Http\Livewire\Components;

use Illuminate\Support\Facades\Cookie;
use Livewire\Component;

class ThemeChange extends Component
{
    public $themeCookie;

    public function changeTheme()
    {
        if (Cookie::has('theme')) {
            if (Cookie::get('theme') == 'dark') {
                Cookie::queue(Cookie::forget('theme'));
                Cookie::queue('theme', 'light', 60 * 24 * 365);
                $this->themeCookie = 'light';
            } else {
                Cookie::queue(Cookie::forget('theme'));
                Cookie::queue('theme', 'dark', 60 * 24 * 365);
                $this->themeCookie = 'dark';
            }
        }
        $this->emit('reset_page', '');
    }

    public function mount()
    {
        if (Cookie::has('theme')) {
            $this->themeCookie = Cookie::get('theme');
        } else {
            Cookie::queue('theme', 'dark', 60 * 24 * 365);
        }
    }

    public function render()
    {
        return view('livewire.components.theme-change');
    }
}
