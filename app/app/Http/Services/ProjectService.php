<?php

declare(strict_types=1);

namespace App\Http\Services;

use App\Data\ProjectData;
use App\Models\Project;
use Illuminate\Database\Eloquent\Model;

class ProjectService
{
    public function store(ProjectData $data): Model
    {
        $project = Project::query()->create($data->toArray());
        $project->save();
        $project->load(['tasks']);

        return $project;
    }

    public function update(Project $project, ProjectData $data): Model
    {
        $project->fill($data->toArray());
        $project->save();
        $project->load(['tasks']);

        return $project;
    }
}
