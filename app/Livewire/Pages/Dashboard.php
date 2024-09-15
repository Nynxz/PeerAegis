<?php

namespace App\Livewire\Pages;

use App\Livewire\Components\TestButton;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\Title;
use Livewire\Component;
use function view;

#[Title('Dashboard')]
class Dashboard extends Component
{
    public function render()
    {
        if(Gate::check('teacher')){
            return view('livewire.pages.teacher-dashboard')->with(["students" => User::all(), "selected" => TestButton::class]);
        } else {
            return view('livewire.pages.dashboard')->with(["students" => User::all(), "selected" => TestButton::class]);
        }
    }
}
