<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Http\Services\ProjectService;
use App\Models\Project;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class ProjectController extends Controller
{
    public function index(): JsonResource
    {
        $projects = Project::with(['tasks'])->paginate(10);

        return ProjectResource::collection($projects);
    }

    public function store(StoreProjectRequest $request, ProjectService $service): JsonResource
    {
        $project = $service->store($request->dto());

        return ProjectResource::make($project);
    }

    public function show(Project $project): JsonResource
    {
        $project->load(['tasks']);

        return ProjectResource::make($project);
    }

    public function edit(Project $project): JsonResource
    {
        $project->load(['tasks']);

        return ProjectResource::make($project);
    }

    public function update(Project $project, StoreProjectRequest $request, ProjectService $service): JsonResource
    {
        $project = $service->update($project, $request->dto());

        return ProjectResource::make($project);
    }

    public function destroy(Project $project): Response
    {
        $project->delete();

        return response()->noContent();
    }
}
