<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct(private readonly TaskService $taskService){}

    public function index(Request $request)
    {

    }

    public function create()
    {

    }

    public function edit(Task $task)
    {

    }

    public function store(TaskRequest $request)
    {

    }

    public function update(Task $task, TaskRequest $request)
    {

    }

    public function destroy(Task $task)
    {

    }
}
