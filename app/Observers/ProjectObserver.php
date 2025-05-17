<?php

namespace App\Observers;

use App\Models\Project;

class ProjectObserver
{
    public function creating(Project $project): void
    {
        $project->user_id = auth()->id();
    }
}
