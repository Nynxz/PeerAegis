<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Group extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "assessment_id"
    ];
    public function assessment(): BelongsTo
    {
        return $this->belongsTo(Assessment::class);
    }

    public function reviews(): HasMany{
        return $this->hasMany(Review::class, 'group_id');
    }

    public function users(){
        return $this->belongsToMany(User::class, 'groups_users', 'group_id', 'user_id');
    }
}
