<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\Course;
use App\Models\Group;
use App\Models\User;
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

    public static function parseJSONCourseFile($json_string): void  {
        $data = json_decode($json_string, true);

        $validator = Validator::make($data, [
            'name' => 'required|string',
            'code' => 'required|string',//|unique:courses,code',
            'students' => ['required', 'array'],
            'students.*' => ['regex:/^[s,S]_\d+$/'],
            'teachers' => ['required', 'array'],
            'teachers.*' => ['regex:/^[t,T]_\d+$/'],
            'assessments' => ['required', 'array'],
            'assessments.*.title' => 'required|string',
            'assessments.*.instructions' => 'required|string',
            'assessments.*.required_reviews' => 'required|integer',
            'assessments.*.minimum_grade' => 'required|integer',
            'assessments.*.due_date' => 'nullable|date',
            'assessments.*.type' => ['required', 'in:student,teacher'],
        ]);

        if ($validator->fails()) {
            // Handle validation failure
            $errors = $validator->errors()->all();
//            dd($errors); // Dump validation errors for debugging
        }
        $data = $validator->validated();

        $data['students'] = array_unique($data['students']);
        $data['teachers'] = array_unique($data['teachers']);

        // Create the course
        $course = Course::create(['name' => $data['name'], 'code' => $data['code']]);

        // Link the teachers
        $teacherIds = User::whereIn('s_number', $data['teachers'])->pluck('id');
        $course->teachers()->syncWithoutDetaching($teacherIds);

        $studentIds = User::whereIn('s_number', $data['students'])->pluck('id');
        $course->students()->syncWithoutDetaching($studentIds);

        // Create the assessments
        foreach ($data['assessments'] as $assessment) {
            $assessment['course_id'] = $course->id;
            $db_assessment = Assessment::create($assessment);
            $db_assessment->course()->associate($course);
            $group = Group::create(['assessment_id' => $db_assessment->id, 'name' => $db_assessment->name." Group"]);
            $group->users()->attach($studentIds);
            $group->assessment()->associate($db_assessment);
        }
        //        $course->assessments()->createMany($data['assessments']);
    }
}
