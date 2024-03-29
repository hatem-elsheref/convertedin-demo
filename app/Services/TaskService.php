<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Column;

class TaskService
{
    public function __construct(private readonly Builder $builder){}

    public function listAllWithPagination($request) :JsonResponse
    {
        $query = Task::query();
        return $this->listTasks($query, $request);
    }


    public function createTask($request) :Task|Model
    {
        return Task::query()->create($request->validated());
    }

    public function tasksAssignedToMe($request) :JsonResponse
    {
        $query = Task::query()->assignedToMe($request);
        return $this->listTasks($query, $request);
    }

    private function listTasks($query, $request) :JsonResponse
    {
        return DataTables::of($query->with('creator', 'user'))
            ->filter(function ($query) use ($request){
                $orderColumn    = $request['order'][0]['name'] ?? 'id';
                $orderDirection = $request['order'][0]['dir']  ?? 'desc';
                $query->orderBy($orderColumn, $orderDirection);
            })->addIndexColumn()
            ->addColumn('title'        , fn($row) => $row->title)
            ->addColumn('description'  , fn($row) => Str::limit($row->description, 30))
            ->addColumn('Assigned Name', fn($row) => $row->user->name)
            ->addColumn('Admin Name'   , fn($row) => $row->creator->name)
            ->addColumn('created_at'   , fn($row) => $row->created_at->diffForHumans())
            ->make();
    }

    public function htmlBuilder() :Builder
    {
        return $this->builder->columns([
            Column::make('id'),
            Column::make('title')->orderable(0),
            Column::make('description')->orderable(0),
            Column::make('Assigned Name')->orderable(0),
            Column::make('Admin Name')->orderable(0),
            Column::make('created_at')->orderable(0),
        ])->setTableAttributes(['class' => 'table table-light table-hover'])
            ->searching(0);
    }

}
