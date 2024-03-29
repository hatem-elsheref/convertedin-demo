<?php

namespace App\Console\Commands;

use App\Enums\Role;
use App\Models\Task;
use App\Models\User;
use Illuminate\Console\Command;

class UpdateUserTasksCount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
//    protected $signature = 'tasks:update-user-tasks-count';
    protected $signature = 'a';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update The Total Count Of Tasks For Each User';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $lastCheck = cache()->get('statistics_last_check');

        $items = Task::query()->when($lastCheck, function ($query) use ($lastCheck){
            $query->where('created_at', '>=', $lastCheck)
                ->orWhere('updated_at', '>=', $lastCheck);
        })->get()->groupBy('assigned_to_id');

        $items = User::query()->where('role', Role::USER->value)
            ->select('id', 'assigned_to_id')
            ->withCount('assignedTasks')
            ->whereHas('assignedTasks', fn ($query) => $query->when(function ($query) use ($lastCheck){
                $query->where('created_at', '>=', $lastCheck)->orWhere('updated_at', '>=', $lastCheck);
            }));

//        foreach ($items as $userId => $tasks)




//        cache()->put('statistics_last_check', now());
    }
}
