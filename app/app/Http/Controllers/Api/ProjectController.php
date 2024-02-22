<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Http\Services\ProjectService;
use App\Models\Project;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Knuckles\Scribe\Attributes\Endpoint;
use Knuckles\Scribe\Attributes\Group;
use Knuckles\Scribe\Attributes\ResponseFromApiResource;
use Knuckles\Scribe\Attributes\Response as DocResponse;

#[Group('Projects')]
class ProjectController extends Controller
{
    #[Endpoint('List of projects', 'Returns list of projects')]
    #[ResponseFromApiResource(
        ProjectResource::class,
        Project::class,
        200,
        collection: true,
        with: ['tasks'],
        paginate: 10
    )]
    #[DocResponse(
        ["error" => "Unauthorized"],
        401,
        "Fail"
    )]
    public function index(): JsonResource
    {
        $projects = Project::with(['tasks'])->paginate(10);

        return ProjectResource::collection($projects);
    }

    #[Endpoint('Create project', 'Creates new project')]
    #[ResponseFromApiResource(
        ProjectResource::class,
        Project::class,
        200,
        with: ['tasks']
    )]
    #[DocResponse(
        ["error" => "Unauthorized"],
        401,
        "Fail"
    )]
    public function store(StoreProjectRequest $request, ProjectService $service): JsonResource
    {
        $project = $service->store($request->dto());

        return ProjectResource::make($project);
    }

    #[Endpoint('View project')]
    #[ResponseFromApiResource(
        ProjectResource::class,
        Project::class,
        200,
        with: ['tasks']
    )]
    #[DocResponse(
        ["error" => "Unauthorized"],
        401,
        "Fail"
    )]
    public function show(Project $project): JsonResource
    {
        $project->load(['tasks']);

        return ProjectResource::make($project);
    }

    #[Endpoint('Edit project')]
    #[ResponseFromApiResource(
        ProjectResource::class,
        Project::class,
        200,
        with: ['tasks']
    )]
    #[DocResponse(
        ["error" => "Unauthorized"],
        401,
        "Fail"
    )]
    public function edit(Project $project): JsonResource
    {
        $project->load(['tasks']);

        return ProjectResource::make($project);
    }

    #[Endpoint('Update project', 'Update project with user data')]
    #[ResponseFromApiResource(
        ProjectResource::class,
        Project::class,
        200,
        with: ['tasks']
    )]
    #[DocResponse(
        ["error" => "Unauthorized"],
        401,
        "Fail"
    )]
    public function update(Project $project, StoreProjectRequest $request, ProjectService $service): JsonResource
    {
        $project = $service->update($project, $request->dto());

        return ProjectResource::make($project);
    }

    #[Endpoint('Delete project', 'Deletes project')]
    #[DocResponse(status: 204)]
    #[DocResponse(
        ["error" => "Unauthorized"],
        401,
        "Fail"
    )]
    public function destroy(Project $project): Response
    {
        $project->delete();

        return response()->noContent();
    }
}
