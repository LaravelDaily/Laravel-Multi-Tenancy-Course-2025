<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Observers\ProjectObserver;
use App\Traits\FilterByTenant;
use App\Traits\FilterByUser;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Builder;

// #[ObservedBy(ProjectObserver::class)]
class Project extends Model
{
    use FilterByTenant;

    protected $fillable = [
        'name',
        'user_id',
        'tenant_id',
    ];

    // protected static function booted()
    // {
    //     static::creating(function (Project $project) {
    //         $project->user_id = auth()->id();
    //     });

    //     static::addGlobalScope(function (Builder $builder) {
    //         $builder->where('user_id', auth()->id());
    //     });
    // }
}
