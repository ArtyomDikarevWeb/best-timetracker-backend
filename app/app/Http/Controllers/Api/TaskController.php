<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Resources\TaskResource;
use App\Http\Services\TaskService;
use App\Models\Task;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class TaskController extends Controller
{
    public function index(): JsonResource
    {
        $tasks = Task::with(['project'])->paginate(10);

        return TaskResource::collection($tasks);
    }

    public function store(StoreTaskRequest $request, TaskService $service): JsonResource
    {
        $task = $service->store($request->dto());

        return TaskResource::make($task);
    }

    public function show(Task $task): JsonResource
    {
        $task->load(['project']);

        return TaskResource::make($task);
    }

    public function edit(Task $task): JsonResource
    {
        $task->load(['project']);

        return TaskResource::make($task);
    }

    public function update(Task $task, StoreTaskRequest $request, TaskService $service): JsonResource
    {
        $task = $service->update($task, $request->dto());

        return TaskResource::make($task);
    }

    public function destroy(Task $task): Response
    {
        $task->delete();

        return response()->noContent();
    }
}
