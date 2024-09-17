<?php

namespace App\Livewire\Pages;

use App\Livewire\Components\TestButton;
use App\Models\Course;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\Reactive;
use Livewire\Attributes\Title;
use Livewire\Component;
use function dd;
use function view;

#[Title('Dashboard')]
class Dashboard extends Component
{
    public $selected = null;

    public $selectedAssessment;

    public $name_search;

    public $filter_courses = false;
    public function render()
    {
        if (Gate::check('teacher')) {
            $courses = !$this->filter_courses ? Course::all() : Course::whereHas('teachers', function (\Illuminate\Database\Eloquent\Builder $query) {
                $query->where('user_id', Auth::id());
            })->get();

            return view('livewire.pages.teacher-dashboard')->with([
                "courses" => $courses,
                "selected" => $this->selected,
                "students" => User::students()->get(),
                "name_search" => $this->name_search,
            ]);
        } else {
            return view('livewire.pages.dashboard')->with(["students" => User::students()->get(), "selected" => TestButton::class]);
        }
    }

    public function test()
    {
        dd("Yes");
    }

    public function select($id)
    {
        $this->selected = Course::find($id);
    }

    public function selectAssessment($assessment)
    {
        $this->selectedAssessment = $assessment;
    }

    public function addTeacher()
    {
        if (Gate::check('teacher') && $this->selected) {
            $this->selected->addTeacher(Auth::user());
        }
    }

    public function refreshCourse()
    {
        $this->selected->refresh();
    }

    public function filterCourses($set){
        $this->filter_courses = $set;
    }
}
