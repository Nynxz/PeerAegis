<?php

namespace App\Livewire\Pages;

use App\Livewire\Components\TestButton;
use App\Models\Assessment;
use App\Models\Course;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Livewire\Attributes\Reactive;
use Livewire\Attributes\Title;
use Livewire\Component;
use function dd;
use function view;

#[Title('Dashboard')]
class Dashboard extends Component {

    public function render(): View {
        return $this->handleStudentDashboard();
    }

//    STUDENT DASHBOARD

    public $selected_course;
    public $selected_assessment;

    private function handleStudentDashboard(): View {
        $courses = Auth::user()->enrolledCourses()->get();
        return view('livewire.pages.dashboard')->with([
            "students" => User::students()->get(),
            "selected" => TestButton::class,
            "courses" => $courses
        ]);
    }

    public function selectCourse(Course $course) {
        $this->selected_course = $course;
    }

    public function selectAssessment(Assessment $assessment) {
        $this->selected_assessment = $assessment;
    }
}
