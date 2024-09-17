<?php

namespace App\Http\Controllers;

use JetBrains\PhpStorm\NoReturn;
use Validator;
use function array_unique;
use function dd;
use function json_decode;

class CourseController extends Controller
{
    public function index()
    {

    }

    #[NoReturn] public static function parseJSONCourseFile($json_string): void  {
        $data = json_decode($json_string, true);

        $validator = Validator::make($data, [
            'name' => 'required|string',
            'code' => 'required|string|unique:courses,code',
            'students' => ['required', 'array'],
            'students.*' => ['regex:/^[s,S]_\d+$/'],
            'teachers' => ['required', 'array'],
            'teachers.*' => ['regex:/^[t,T]_\d+$/'],
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
        $data = $validator->validated();

        $data['students'] = array_unique($data['students']);
        $data['teachers'] = array_unique($data['teachers']);

        dd($data);


    }
}
