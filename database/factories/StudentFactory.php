<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class StudentFactory extends Factory
{

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt($this->faker->password()),
            's_number' => $this->getRandomSNumber(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    function getRandomSNumber(): string
    {
        return 's_'. random_int(1000000, 9999999);
    }
}
