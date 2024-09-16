<?php

namespace App\Livewire\Pages;

use App\Livewire\Components\TestButton;
use App\Models\Course;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\Title;
use Livewire\Component;
use function dd;
use function view;

#[Title('Dashboard')]
class Dashboard extends Component
{
    public $selected = null;
    public function render()
    {
        if(Gate::check('teacher')){
            $courses = Course::all();

            return view('livewire.pages.teacher-dashboard')->with(["courses"=>$courses, "selected"=>$this->selected, "students" => User::students()->get()]);
        } else {
            return view('livewire.pages.dashboard')->with(["students" => User::students()->get(), "selected" => TestButton::class]);
        }
    }

    public function test(){
        dd("Yes");
    }

    public function select($id){
        $this->selected = Course::find($id);
    }

    public function addTeacher(){
        if(Gate::check('teacher') && $this->selected){
            $this->selected->addTeacher(Auth::user());
        }
    }
}
