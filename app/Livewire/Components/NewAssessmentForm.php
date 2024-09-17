<?php

namespace App\Livewire\Components;

use App\Models\Assessment;
use App\Models\Course;
use App\Models\Groupold;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\Reactive;
use Livewire\Attributes\Validate;
use Livewire\Component;
use function array_chunk;
use function array_push;
use function count;
use function now;

class NewAssessmentForm extends Component
{
    #[Reactive]
    #[Validate('required', message: "A course must be selected")]
    public $course;

    #[Reactive]
    public $assessment;

    #[Validate('string|required|max:20', message: "Title is required")]
    public $title = "Default Title";
    #[Validate('string|required', message: "Instructions is required")]
    public $instructions = "Default Instructions";
    #[Validate('date|required', message: "Due Date is required")]
    public $due_date;

    #[Validate('numeric|required', message: "Max Score is required")]
    public $max_score = 50;
    #[Validate('numeric|required', message: "Required Reviews is required")]
    public $required_reviews = 0;

    #[Validate('string|in:student,teacher|required', message: "Instructions is required")]
    public $assessment_type = "student";

    private $error = "";

    public $groups;

    public function render()
    {
        if($this->course){
            $assessments = Assessment::where('course_id', $this->course->id)->get();
        }
        return view('livewire.components.new-assessment-form')->with(['course' => $this->course, 'assessments' => $assessments ?? [], 'error' => $this->error, 'max_score' => $this->max_score]);
    }

    public function newAssessment(){
        $this->validate();
        if(Gate::allows('createAssessment', $this->course)){
            $assessment = Assessment::create([
                'course_id' => $this->course->id,
                'title' => $this->title,
                'instructions' => $this->instructions,
                'due_date' => $this->due_date,
                'required_reviews' => $this->required_reviews,
                'type' => $this->assessment_type,
                'minimum_grade' => $this->max_score,
            ]);

            if($this->assessment_type == 'teacher') {
                foreach ($this->groups as $groupIndex => $groupUsers) {

                    $group = Groupold::create([
                        'name' => "Groupold ".$groupIndex+1,
                    ]);

                    $assessment->groups()->attach($group->id);

                    foreach ($groupUsers as $user) {
                        // Attach users to the group via the many-to-many relationship
                        $group->users()->attach($user['id']);
                    }
                }
            }

            $this->dispatch('submitted');
        } else {
            $this->error = "You are not teaching this course!";
        }
    }

    public function shuffleGroups(){
        //                AUTO GROUP SPLIT
        $students = Course::find($this->course->id)->students()->get()->shuffle()->toArray();
        // if required = 1, then chunk_size = 2 >>> (you + them <3 4 eva)
        $this->groups = array_chunk($students, $this->required_reviews+1);
//                dd($this->groups );
    }

    public function moveUserUp($group, $user){
        array_push($this->groups[$group-1],$this->groups[$group][$user]);
        unset($this->groups[$group][$user]);
        if(count($this->groups[$group]) == 0){
            unset($this->groups[$group]);
        }
//        dd($this->groups[$group][$user]);
    }

    public function moveUserDown($group, $user){
        if(!isset($this->groups[$group+1])){
            $this->groups[$group+1] = [];
        }
        array_push($this->groups[$group+1],$this->groups[$group][$user]);
        unset($this->groups[$group][$user]);
        if(count($this->groups[$group]) == 0){
            unset($this->groups[$group]);
        }
//        dd($this->groups[$group][$user]);
    }
}
