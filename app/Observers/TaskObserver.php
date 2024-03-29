<?php

namespace App\Observers;

use App\Models\Statistics;
use App\Models\Task;

class TaskObserver
{
    public function created($task) :void
    {
        $totalTasks = Task::query()->where('assigned_to_id', $task->assigned_to_id)->count();

        Statistics::query()->updateOrCreate(['user_id' => $task->assigned_to_id], ['count' => $totalTasks]);
    }

    public function deleted($task) :void
    {
        $totalTasks = Task::query()->where('assigned_to_id', $task->assigned_to_id)->count();

        Statistics::query()->updateOrCreate(['user_id' => $task->assigned_to_id], ['count' => $totalTasks]);
    }
}
