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
    public $group_users;
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
        $this->selected_assessment = null;
        $this->group_users = null;

    }

    public function selectAssessment(Assessment $assessment) {
        $this->selected_assessment = $assessment;

        if($assessment->type == 'teacher'){
            $userGroups = Auth::user()->groups;
            $assessmentGroups = $assessment->groups;
            $userGroupsInAssessment = $assessmentGroups->intersect($userGroups)->first();
            $this->group_users = $userGroupsInAssessment->users()->whereNot('user_id', Auth::user()->id)->get()->toArray();
        } else {
//            $this->group_users =
            $this->group_users = $assessment->course()->first()->students()->get()->toArray();
        }
//        dd($assessment->groups()->whereBelongsTo(Auth::user())->get());
//        $AllUserGroups = Auth::user()->groups()->get();
////        dd($AllUserGroups);
//        $assessmentGroup = $AllUserGroups->where('assessment_id', '<>', $assessment->id );
//        dd($assessmentGroup);

//        dd(Auth::user()->groups()->all()->get());
//        dd(Auth::user()->groups()
//            ->whereHas('assessment', fn($query) => $query->where('assessment_id', $assessment->id))->users()
//            ->get());
    }
}
