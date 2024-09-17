<?php

namespace App\Livewire\Components;

use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Validator;
use function json_decode;
use function view;

class CourseUploader extends Component
{

    use WithFileUploads;

    #[Validate('json|max:1024')] // 1MB Max
    public $photo;

    public function render()
    {
        return view('livewire.components.course-uploader');
    }

    public function save()
    {
        $contents = file_get_contents($this->photo->getRealPath());

        // Decode JSON data
        $data = json_decode($contents, true);

        $validator = Validator::make($data, [
            'name' => 'required|string',
            'code' => 'required|string|unique:courses,code',
            'students' => ['required', 'array', 'distinct'],
            'students.*' => ['regex:/^s_\d+$/'],
            'teachers' => ['required', 'array'],
            'teachers.*' => ['regex:/^t_\d+$/'],
            'assessments' => ['required', 'array'],
            'assessments.*.title' => 'required|string',
            'assessments.*.instructions' => 'required|string',
            'assessments.*.required_reviews' => 'required|integer',
            'assessments.*.required_score' => 'required|integer',
            'assessments.*.due_date' => 'nullable|date',
            'assessments.*.type' => ['required', 'in:student,teacher'],
        ]);

        if ($validator->fails()) {
            // Handle validation failure
            $errors = $validator->errors()->all();
            dd($errors); // Dump validation errors for debugging
        }

        dd($data);
//        $path = $this->photo->store(path: 'photos');
//        $json = json_decode(Storage::get($path));
//        dd($json);
    }
}
