<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Database\Eloquent\Model;

class TaskService
{
    public function listAllWithPagination()
    {
        $query = Task::query();
        return $this->listTasks($query);
    }

    public function deleteTask($task) :bool
    {
        return $task->delete();
    }

    public function createTask($request) :Task|Model
    {
        return Task::query()->create($request->validated());
    }
    public function updateTask($task, $request) :bool
    {
        return $task->update($request->validated());
    }

    public function tasksCreatedByMe()
    {
        $query = Task::query()->assignedToMe();
        return $this->listTasks($query);
    }

    public function tasksAssignedToMe()
    {
        $query = Task::query()->assignedToMe();
        return $this->listTasks($query);
    }

    private function listTasks($query)
    {

    }
}
