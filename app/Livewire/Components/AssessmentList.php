<?php

namespace App\Livewire\Components;

use App\Models\Assessment;
use Livewire\Attributes\Reactive;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AssessmentList extends Component
{

    #[Reactive]
    public $course;

    public function render()
    {
        if($this->course){
            $assessments = Assessment::where('course_id', $this->course->id)->get();
        }
        return view('livewire.components.assessment-list')->with('assessments', $assessments ?? []);
    }

    public function selectAssessment($assessment){
        $this->dispatch('ss', assessment: $assessment);
    }
}
