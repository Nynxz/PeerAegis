<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    protected function casts(): array
    {
        return [
            'due_date' => 'datetime',
        ];
    }
}
