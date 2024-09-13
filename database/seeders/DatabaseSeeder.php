<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Student::factory()->count(25)->create();
        Student::factory()->create([
            'name' => 'Henry Lee',
            's_number' => 's_5238766',
            'email' => 'student@email.com',
            'password' => 'student'
        ]);

        Teacher::factory()->create([
            'username' => 'teacher2',
            'password' => 'password2'
        ]);

        Teacher::factory()->create([
            'username' => 'teacher2',
            'password' => 'password2'
        ]);
    }
}
