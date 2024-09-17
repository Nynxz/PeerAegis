<?php

namespace App\Livewire\Components;

use App\Models\Assessment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\Reactive;
use Livewire\Attributes\Validate;
use Livewire\Component;
use function now;

class NewAssessmentForm extends Component
{
    #[Reactive]
    #[Validate('required', message: "A course must be selected")]
    public $course;

    #[Reactive]
    public $assessment;

    #[Validate('string|required|max:20', message: "Title is required")]
    public $title;
    #[Validate('string|required', message: "Instructions is required")]
    public $instructions;
    #[Validate('date|required', message: "Due Date is required")]
    public $due_date;

    #[Validate('numeric|required', message: "Max Score is required")]
    public $max_score = 0;
    #[Validate('numeric|required', message: "Required Reviews is required")]
    public $required_reviews = 0;

    #[Validate('string|in:student,teacher|required', message: "Instructions is required")]
    public $assessment_type = "student";

    private $error = "";

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
            Assessment::create([
                'course_id' => $this->course->id,
                'title' => $this->title,
                'instructions' => $this->instructions,
                'due_date' => $this->due_date,
                'required_reviews' => $this->required_reviews,
                'type' => $this->assessment_type,
                'minimum_grade' => $this->max_score,
            ]);
            $this->dispatch('submitted');
        } else {
            $this->error = "You are not teaching this course!";
        }
    }
}
