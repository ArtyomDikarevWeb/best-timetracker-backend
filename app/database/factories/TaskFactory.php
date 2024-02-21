<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Task;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    protected $model = Task::class;
    public function definition(): array
    {
        return [
            'project_id' => Project::query()->inRandomOrder()->first(),
            'title' => fake()->words(5, true),
        ];
    }
}
