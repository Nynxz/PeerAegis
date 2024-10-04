<?php

namespace App\Livewire\Pages;

use App\Http\Controllers\UsefulnessAI;
use App\Livewire\Components\TestButton;
use App\Models\Assessment;
use App\Models\Course;
use App\Models\Review;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;
use Livewire\Attributes\Modelable;
use Livewire\Attributes\Reactive;
use Livewire\Attributes\Title;
use Livewire\Component;
use Validator;
use function dd;
use function in_array;
use function json_decode;
use function redirect;
use function view;

#[Title('Dashboard')]
class Dashboard extends Component {

    public function render(): View {
        return $this->handleStudentDashboard();
    }

//    STUDENT DASHBOARD

    public $selected_course;
    public $selected_assessment;

    public $selected_user;

    public $selected_user_type;
    public $selected_review;

    public $group_users;
    public $group_reviews;
    public $group_users_to_review;
    public $user_assessment_group;


    public $review_content;

    public $http_message;

    public $ai_loading = "hi";

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

            $this->user_assessment_group = $selected_assessment_group = Auth::user()->groups->firstWhere('assessment_id', $assessment->id);
            $selected_assessment_group->assessment()->first(); // Selected Group's Assessment
            $this->group_reviews = $selected_assessment_group->reviews()->whereRevieweeId(Auth::id())->get();//Received Reviews
            $selected_assessment_group->reviews()->whereReviewerId(Auth::id())->get(); //Created Reviews
            $reviewed_user_ids = $selected_assessment_group->reviews()->whereReviewerId(Auth::id())->pluck('reviewee_id')->toArray(); //Created Reviews User Id
            $this->group_users = $selected_assessment_group->users()->whereNot('id', Auth::id())->get(); //All Group Users
            $this->group_users_to_review = $selected_assessment_group->users()->whereNot('id', Auth::id())->get()->filter(function ($user) use ($reviewed_user_ids) {
                return !in_array($user->id, $reviewed_user_ids);
            });

        } else {
            $selected_assessment_group = Auth::user()->groups->firstWhere('assessment_id', $assessment->id);
            $this->user_assessment_group = $selected_assessment_group = Auth::user()->groups->firstWhere('assessment_id', $assessment->id);
            $this->group_users = $assessment->course()->first()->students()->get()->toArray();
            $this->group_reviews = $selected_assessment_group->reviews()->whereRevieweeId(Auth::id())->get();
            $reviewed_user_ids = $selected_assessment_group->reviews()->whereReviewerId(Auth::id())->pluck('reviewee_id')->toArray(); //Created Reviews User Id
            $this->group_users_to_review = $selected_assessment_group->users()->whereNot('id', Auth::id())->get()->filter(function ($user) use ($reviewed_user_ids) {
                return !in_array($user->id, $reviewed_user_ids);
            });
            $this->selected_user = null;
            $this->review_content = null;
        }
    }
    public function selectUser(User $user, int $type) {
        $this->selected_user = $user;
        $this->selected_user_type = $type;

        if($type == 1){
            $this->selected_review = $this->group_reviews->where('reviewer_id', '==', $user->id)->first()->content;
        }

        //Type 1 = as receiver (reading a review)
        // Type 0 = as reviewer (writing a review)
    }



    public function generateAIResponse(){
        $form = [
            "reviewer_id" => Auth::user()->id,
            "group_id" => $this->user_assessment_group->id,
            "reviewee_id" => $this->selected_user->id,
            "content" => $this->review_content
        ];
        $this->http_message = UsefulnessAI::prompt($form);
    }
    public function send_review(){
        $form = [
            "reviewer_id" => Auth::user()->id,
            "group_id" => $this->user_assessment_group->id,
            "reviewee_id" => $this->selected_user->id,
            "content" => "Review: ".$this->review_content
        ];

        $review = Review::create($form);
        $this->selectAssessment($this->selected_assessment);
    }
}
