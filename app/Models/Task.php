<?php

namespace App\Models;

use App\Traits\FilterByTenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
use App\Traits\FilterByUser;

class Task extends Model
{
    use FilterByTenant;

    protected $fillable = [
        'name',
        'project_id',
        'user_id',
        'tenant_id',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    // protected static function booted()
    // {
    //     // static::creating(function (Task $task) {
        //     $task->user_id = auth()->id();
        // });

        // static::addGlobalScope(function (Builder $builder) {
        //     // $builder->where('user_id', auth()->id());
        //     $builder->whereRelation('project', 'user_id', auth()->id());
        // });
    // }
}
