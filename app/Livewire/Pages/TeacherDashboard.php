<?php


namespace App\Livewire\Pages;

use App\Models\Assessment;
use App\Models\Course;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Livewire\Component;
use function dd;
use function view;

class TeacherDashboard extends Component {
    public $selected = null;
    public $selectedAssessment;
    public $name_search;
    public $filter_courses = false;
    public $seeAllStudents = false;

    public $courses;
    public function render() {
        return $this->Dashboard();
    }

    public function Dashboard(): View {
        $this->courses = !$this->filter_courses ? Course::all() : Course::whereHas('teachers', function (\Illuminate\Database\Eloquent\Builder $query) {
            $query->where('user_id', Auth::id());
        })->get();

        return view('livewire.pages.teacher-dashboard')->with([
            "courses" => $this->courses,
            "selected" => $this->selected,
            "students" => User::students()->get(),
            "name_search" => $this->name_search,
        ]);
    }

    public function test()
    {
        dd("Yes");
    }

    public function select($id)
    {
        if($this->selected && $this->selected->id == $id){
            $this->selected = null;
        } else {
            $this->selected = Course::find($id);
        }
    }

    public function selectAssessment($assessment)
    {
        dd(Assessment::find($assessment['id'])->groups()->first()->users()->get());
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
        if($this->selected){
            $this->selected->refresh();
        }

        $this->courses = !$this->filter_courses ? Course::all() : Course::whereHas('teachers', function (\Illuminate\Database\Eloquent\Builder $query) {
            $query->where('user_id', Auth::id());
        })->get();
    }

    public function filterCourses($set){
        $this->filter_courses = $set;
    }

    public function toggleAlLStudents(){
        $this->seeAllStudents = !$this->seeAllStudents;
    }

}
