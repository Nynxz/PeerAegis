<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
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

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'teachers_courses');
    }

    public function scopeStudents($query)
    {
        return $query->where('role', 'student');
    }
}
