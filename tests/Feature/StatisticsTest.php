<?php

namespace Tests\Feature;

use App\Enums\Role;
use App\Jobs\UpdateUsersTotalCount;
use App\Models\Statistics;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Tests\TestCase;

class StatisticsTest extends TestCase
{
    public function test_statistics_returns_the_top_users(): void
    {
        $admin = User::query()->where('role', Role::ADMIN->value)->first();
        $user  = User::query()->where('role', Role::USER->value)->first();
        $tasks = [];


        $_user = User::query()->where('role', Role::USER->value)
            ->select('id')
            ->where('id', $user->id)
            ->withCount('assignedTasks as total')
            ->whereHas('assignedTasks')
            ->first();

        UpdateUsersTotalCount::dispatchSync($_user);


        $totalTasksBeforeAddingNewTasks = Statistics::query()->where('user_id', $user->id)->first()->total_tasks;

        $total = Task::query()->where('assigned_to_id', $user->id)->count();

        $this->assertEquals($total, $totalTasksBeforeAddingNewTasks);

        foreach (range(1, 50) as $item){
            $tasks[] = [
                'title'          => 'New Testing Task #' . Str::uuid()->toString(),
                'description'    => 'New Task Created From Testing ' . Str::uuid()->toString(),
                'assigned_by_id' => $admin->id,
                'assigned_to_id' => $user->id,
                'created_at'     => now()->toDateTimeString(),
                'updated_at'     => now()->toDateTimeString(),
            ];
        }

        DB::table('tasks')->insert($tasks);

        $_user = User::query()->where('role', Role::USER->value)
            ->select('id')
            ->where('id', $user->id)
            ->withCount('assignedTasks as total')
            ->whereHas('assignedTasks')
            ->first();

        UpdateUsersTotalCount::dispatchSync($_user);

        $total = Task::query()->where('assigned_to_id', $user->id)->count();

        $totalTasksNow = Statistics::query()->where('user_id', $user->id)->first()->total_tasks;

        $this->assertNotEquals($total, $totalTasksBeforeAddingNewTasks);

        $this->assertEquals($total, $totalTasksNow);
    }
}
