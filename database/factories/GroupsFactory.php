<?php

namespace Database\Factories;

use App\Models\Assessment;
use App\Models\Groups;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class GroupsFactory extends Factory
{
    protected $model = Groups::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'assessment_id' => Assessment::factory(),
        ];
    }
}
