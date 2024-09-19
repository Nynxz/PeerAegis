<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected string $guard = 'user';

    protected $fillable = [
        'name',
        'email',
        'password',
        's_number',
        'role',
    ];

    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function teachingCourses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'teachers_courses');
    }

    public function enrolledCourses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'students_courses');
    }

    public function groups():BelongsToMany{
        return $this->belongsToMany(Group::class, 'groups_users');
    }

    public function reviewsReceived(): HasMany {
        return $this->hasMany(Review::class, 'reviewee_id' );
    }

    public function reviewsCreated(): HasMany {
        return $this->hasMany(Review::class, 'reviewer_id' );
    }

    public function scopeStudents(Builder $query): void
    {
        $query->where('role', 'student');
    }

    public function scopeTeachers(Builder $query): void
    {
        $query->where('role', 'teacher');
    }
}
