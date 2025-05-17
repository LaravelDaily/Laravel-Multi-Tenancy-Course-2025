<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Observers\ProjectObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

// #[ObservedBy(ProjectObserver::class)]
class Project extends Model
{
    protected $fillable = [
        'name',
        'user_id',
    ];

    protected static function booted()
    {
        static::creating(function (Project $project) {
            $project->user_id = auth()->id();
        });
    }
}
