<?php

namespace App\Console\Commands;

use App\Enums\Role;
use App\Jobs\UpdateUsersTotalCount;
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
    protected $signature = 'tasks:update-user-tasks-count';

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

        $users = User::query()->where('role', Role::USER->value)
            ->select('id')
            ->withCount('assignedTasks as total')
            ->whereHas('assignedTasks', fn ($query) => $query->when($lastCheck, function ($query) use ($lastCheck){
                $query->where('created_at', '>=', $lastCheck);
            }))->get();

        foreach ($users as $user)
            UpdateUsersTotalCount::dispatch($user);

        cache()->put('statistics_last_check', now());
    }
}
