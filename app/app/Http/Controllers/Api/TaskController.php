<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Resources\TaskResource;
use App\Http\Services\TaskService;
use App\Models\Task;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Knuckles\Scribe\Attributes\Endpoint;
use Knuckles\Scribe\Attributes\Group;
use Knuckles\Scribe\Attributes\ResponseFromApiResource;
use Knuckles\Scribe\Attributes\Response as DocResponse;

#[Group('Tasks')]
class TaskController extends Controller
{
    #[Endpoint('Get list of tasks', 'Returns list of tasks')]
    #[ResponseFromApiResource(
        TaskResource::class,
        Task::class,
        200,
        collection: true,
        with: ['project'],
        paginate: 10
    )]
    #[DocResponse(
        ["error" => "Unauthorized"],
        401,
        "Fail"
    )]
    public function index(): JsonResource
    {
        $tasks = Task::with(['project'])->paginate(10);

        return TaskResource::collection($tasks);
    }

    #[Endpoint('Create task', 'Creates new task')]
    #[ResponseFromApiResource(
        TaskResource::class,
        Task::class,
        200,
        with: ['project'],
    )]
    #[DocResponse(
        ["error" => "Unauthorized"],
        401,
        "Fail"
    )]
    public function store(StoreTaskRequest $request, TaskService $service): JsonResource
    {
        $task = $service->store($request->dto());

        return TaskResource::make($task);
    }

    #[Endpoint('View task')]
    #[ResponseFromApiResource(
        TaskResource::class,
        Task::class,
        200,
        with: ['project'],
    )]
    #[DocResponse(
        ["error" => "Unauthorized"],
        401,
        "Fail"
    )]
    public function show(Task $task): JsonResource
    {
        $task->load(['project']);

        return TaskResource::make($task);
    }

    #[Endpoint('Edit task')]
    #[ResponseFromApiResource(
        TaskResource::class,
        Task::class,
        200,
        with: ['project'],
    )]
    #[DocResponse(
        ["error" => "Unauthorized"],
        401,
        "Fail"
    )]
    public function edit(Task $task): JsonResource
    {
        $task->load(['project']);

        return TaskResource::make($task);
    }

    #[Endpoint('Update task', 'Update task with user data')]
    #[ResponseFromApiResource(
        TaskResource::class,
        Task::class,
        200,
        with: ['project'],
    )]
    #[DocResponse(
        ["error" => "Unauthorized"],
        401,
        "Fail"
    )]
    public function update(Task $task, StoreTaskRequest $request, TaskService $service): JsonResource
    {
        $task = $service->update($task, $request->dto());

        return TaskResource::make($task);
    }

    #[Endpoint('Delete task')]
    #[DocResponse(status: 204)]
    #[DocResponse(
        ["error" => "Unauthorized"],
        401,
        "Fail"
    )]
    public function destroy(Task $task): Response
    {
        $task->delete();

        return response()->noContent();
    }
}
