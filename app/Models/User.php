<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected string $guard = 'user';

    protected $fillable = [
        'name',
        's_number',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
    ];
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'teachers_courses');
    }

    public function enrolledCourses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'students_courses');
    }

    public function groups():BelongsToMany{
        return $this->belongsToMany(Groupold::class, 'group_user');
    }

    public function scopeStudents(Builder $query): void
    {
        $query->where('role', 'student');
    }
}
