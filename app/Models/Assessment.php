<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Assessment extends Model
{
    use HasFactory;

    protected $fillable = [
        "course_id",
        "title",
        "instructions",
        "instructor_id",
        "due_date",
        "required_reviews",
        "type",
        "minimum_grade",
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function groups(): HasMany
    {
        return $this->HasMany(Group::class, 'assessment_id');
    }

    public function students(): HasManyThrough{
        return $this->hasManyThrough(User::class, Groupold::class, 'id', 'id', 'id', 'id' );
    }

    protected function casts(): array
    {
        return [
            'due_date' => 'datetime',
        ];
    }
}
