<?php

namespace App\Data;

use Carbon\Carbon;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;

class TaskData extends Data
{
    public string $title;
    public int $project_id;
    public ?bool $is_completed;
    #[WithCast(DateTimeInterfaceCast::class)]
    public ?Carbon$finished_at;
}
