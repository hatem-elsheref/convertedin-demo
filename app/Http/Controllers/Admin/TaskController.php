<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function __construct(private readonly TaskService $taskService){}

    public function index(Request $request) :View|JsonResponse
    {
        if ($request->ajax())
            return $this->taskService->listAllWithPagination($request);


        $html = $this->taskService->htmlBuilder();

        return view('admin.task.index', compact('html'));
    }

    public function userTasks(Request $request) :View|JsonResponse
    {
        if ($request->ajax())
            return $this->taskService->tasksAssignedToMe($request);

        $html = $this->taskService->htmlBuilder();

        return view('tasks', compact('html'));
    }

    public function create() :View
    {
        return view('admin.task.create');
    }

    public function store(TaskRequest $request) :RedirectResponse
    {
        return redirect()->route('admin.tasks.index')->with('status', $this->taskService->createTask($request));
    }

    public function statistics() :View
    {
        $topUsers = $this->taskService->getTopUsers();

        return view('admin.statistics', compact('topUsers'));
    }
}
