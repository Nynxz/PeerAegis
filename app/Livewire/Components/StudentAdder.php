<?php

namespace App\Livewire\Components;

use App\Models\User;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class StudentAdder extends Component
{

    #[Reactive]
    public $name_search;
    public function render()
    {
        $students = User::students()->where('name', 'like', '%' . $this->name_search . '%')->get();
        return view('livewire.components.student-adder')->with('students', $students);
    }
}
