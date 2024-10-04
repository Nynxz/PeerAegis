<?php

namespace App\Livewire\Components;

use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
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
    public $courseFile;

    public function render(): View
    {
        return view('livewire.components.course-uploader');
    }

    public function save()
    {
        $contents = file_get_contents($this->courseFile->getRealPath());
        CourseController::parseJSONCourseFile($contents);
        $this->dispatch('uploaded');
    }
}
