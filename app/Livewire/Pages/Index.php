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
        $students = User::all();
//        return view('livewire.index')->layout('components.layouts.dashboard')
////            ->with('students', $students);
         return view('livewire.pages.index');
    }
}
