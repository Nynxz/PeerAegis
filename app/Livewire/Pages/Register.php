<?php

namespace App\Livewire\Pages;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title("Login")]
class Register extends Component
{
    public function render()
    {
        return view('livewire.pages.login');
    }
}
