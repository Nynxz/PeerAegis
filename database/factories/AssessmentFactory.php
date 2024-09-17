<?php

namespace Database\Factories;

use App\Models\Assessment;
use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class AssessmentFactory extends Factory
{
    protected $model = Assessment::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
            'instructions' => $this->faker->word(),
            'due_date' => Carbon::now(),
            'required_reviews' => rand(1, 10),
            'type' => array('student', 'teacher')[rand(0, 1)],
            'minimum_grade' => rand(1, 100),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
