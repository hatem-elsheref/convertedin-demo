<?php

namespace App\Observers;

use App\Models\Statistics;

class TaskObserver
{
    public function created($task) :void
    {
        Statistics::query()->where('user_id', $task->assigned_to_id)
            ->increment('count');
    }
}
