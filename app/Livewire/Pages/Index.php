<?php

namespace App\Livewire\Pages;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Home')]
#[Layout('layouts.app')]
class Index extends Component
{

    public function render()
    {
         return view('livewire.pages.index');
    }
}
