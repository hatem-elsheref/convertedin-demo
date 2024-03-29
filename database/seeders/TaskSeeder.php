<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users  = User::query()->where('role', Role::USER->value)
            ->inRandomOrder()->take(100)->pluck('id')->toArray();

        $admins = User::query()->where('role', Role::ADMIN->value)
            ->inRandomOrder()
            ->pluck('id')->toArray();

        $tasks = [];

        foreach (range(1, 100) as $task)
            $tasks[] = [
                'title'          => "Task Title $task",
                'description'    => "Task Description $task",
                'assigned_by_id' => $admins[rand(0, 99)],
                'assigned_to_id' => $users[rand(0, 99)],
                'created_at'     => now()->toDateTimeString(),
                'updated_at'     => now()->toDateTimeString()
            ];


        DB::table('tasks')->insert($tasks);
    }
}
