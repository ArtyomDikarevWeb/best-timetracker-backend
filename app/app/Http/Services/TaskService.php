<?php

declare(strict_types=1);

namespace App\Http\Services;

use App\Data\TaskData;
use App\Models\Task;
use Illuminate\Database\Eloquent\Model;

class TaskService
{
    public function store(TaskData $data): Model
    {
        $task = Task::query()->create($data->toArray());
        $task->save();
        $task->load(['project']);

        return $task;
    }

    public function update(Task $task, TaskData $data): Model
    {
        $task->fill($data->toArray());
        $task->save();
        $task->load(['project']);

        return $task;
    }
}
