<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use function random_int;

class CourseFactory extends Factory
{
    protected $model = Course::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->jobTitle()." Studies",
            'code' => $this->random_course_code(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }

    public function random_course_code():string {
        $suffix = array("ICT", "MSC", "ENG", "CCJ", "AFE", "CSR", "PSY", "HSV");
        $i = random_int(0,7);
        return random_int(1000, 9999).$suffix[$i];
    }
}
