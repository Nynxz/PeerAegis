<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "code"
    ];

    public function teachers()
    {
        return $this->belongsToMany(User::class, 'teachers_courses');
    }

    public function addTeacher($teacher)
    {
        $this->teachers()->syncWithoutDetaching($teacher);
    }

    public function students(){
        return $this->belongsToMany(User::class, 'students_courses');
    }

    public function assessments(){
        return $this->hasMany(Assessment::class, 'course_id');
    }

    public function addStudent($student){
        $this->students()->syncWithoutDetaching($student['id']);
    }

    public function removeStudent($student){
        $this->students()->detach($student['id']);
    }

}
