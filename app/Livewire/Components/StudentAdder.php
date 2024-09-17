<?php

namespace App\Livewire\Components;

use App\Models\User;
use Gate;
use Livewire\Attributes\Reactive;
use Livewire\Component;
use function view;

class StudentAdder extends Component
{

    #[Reactive]
    public $name_search;

    #[Reactive]
    public $course;

    #[Reactive]
    public $allStudents;

    public function render()
    {
        if($this->course != null && !$this->allStudents){
            $students = $this->course->students()->where('name', 'like', '%' . $this->name_search . '%')->get();
            return view('livewire.components.student-adder')->with('students', $students);
        } else {
            $enrolledStudentIds = $this->course->students()->pluck('user_id');
            $students = User::students()->whereNotIn('id', $enrolledStudentIds)->where('name', 'like', '%' . $this->name_search . '%')->get();
            return view('livewire.components.student-adder')->with('students', $students);
        }
    }

    public function toggleStudent($student){
        if(Gate::allows('createAssessment', $this->course)){
            if($this->allStudents){
                $this->course->addStudent($student);
            } else {
                $this->course->removeStudent($student);
            }
        }
        $this->dispatch('update');
    }
}
