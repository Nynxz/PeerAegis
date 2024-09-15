<?php

namespace App\Livewire\Components;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Navbar extends Component
{
    public function render()
    {
        return view('livewire.components.navbar');
    }

    public function logout(){
        Auth::logout();
        session()->invalidate();

        session()->regenerateToken();

        return redirect('/');
    }
}
