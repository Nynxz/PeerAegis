<?php

namespace App\Livewire\Components;

use App\Models\Assessment;
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



    #[Validate('string|required', message: "Title is required")]
    public $title;
    #[Validate('string|required', message: "Instructions is required")]
    public $instructions;
    #[Validate('date|required', message: "Due Date is required")]
    public $due_date;


    public function render()
    {
        if($this->course){
            $assessments = Assessment::where('course_id', $this->course->id)->get();
        }
        return view('livewire.components.new-assessment-form')->with(['course' => $this->course, 'assessments' => $assessments ?? []]);
    }

    public function newAssessment(){
        $this->validate();
        Assessment::create([
            'course_id' => $this->course->id,
            'title' => $this->title,
            'instructions' => $this->instructions,
            'due_date' => $this->due_date,
            'required_reviews' => 3,
            'type' => 'student',
            'minimum_grade' => 50
        ]);
        $this->assessments = Assessment::where('course_id', $this->course->id)->get();
    }
}
