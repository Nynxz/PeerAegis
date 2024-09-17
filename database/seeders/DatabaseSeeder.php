<?php

namespace Database\Seeders;

use App\Models\Assessment;
use App\Models\Course;
use App\Models\User;
use App\Models\Teacher;
use Database\Factories\AssessmentFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->count(25)->create();

        User::factory()->create([
            'name' => 'Henry Lee',
            's_number' => 's_5238766',
            'email' => 'student@email.com',
            'password' => 'student'
        ]);

        User::factory()->create([
            'name' => 'Timmy Jones',
            's_number' => 's_5238767',
            'email' => 'student@email.com',
            'password' => 'password'
        ]);



        User::factory()->create([
            'name' => 'Teacher 1',
            's_number' => 't_1',
            'email' => 'teacher1@email.com',
            'password' => 'password',
            'role' => 'teacher'
        ]);

        User::factory()->create([
            'name' => 'Teacher 2',
            's_number' => 't_2',
            'email' => 'teacher1@email.com',
            'password' => 'password',
            'role' => 'teacher'
        ]);


        Course::factory()->hasAssessments(2)->count(12)->create();
//        Assessment::factory()->count(12)->create();

    }
}
