<?php

namespace Tests\Feature;

use App\Enums\Role;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Str;
use Tests\TestCase;

class TaskTest extends TestCase
{
    public function test_task_listing_returns_a_successful_response(): void
    {
        $admin = User::query()->first();

        $totalTasks = Task::query()->count();

        $response = $this->actingAs($admin)->get('/admin/tasks', ['X-Requested-With' => 'XMLHttpRequest']);

        $this->assertEquals($totalTasks, $response->json('recordsTotal'), 'Task Listing Is Ok');
        $response->assertJsonCount($totalTasks, 'data');

        $response->assertStatus(200);

    }

    public function test_task_listing_returns_valid_view(): void
    {
        $user = User::query()->first();
        $response = $this->actingAs($user)->get('/admin/tasks');

        $response->assertSeeText('List Tasks');
        $response->assertStatus(200);
    }

    public function test_user_cannot_access_all_tasks_and_statistics_page(): void
    {
        $user = User::query()->where('role', Role::USER->value)->first();

        $response = $this->actingAs($user)->get('/admin/tasks', ['X-Requested-With' => 'XMLHttpRequest']);

        $response->assertStatus(403);

        $response = $this->actingAs($user)->get('/admin/statistics');

        $response->assertSeeText('Not Allowed To You To Access This Resource!!');

        $response->assertStatus(403);
    }

    public function test_create_new_task(): void
    {
        $admin = User::query()->where('role', Role::ADMIN->value)->first();
        $user  = User::query()->where('role', Role::USER->value)->first();

        $title = 'New Testing Task #' . Str::uuid()->toString();
        $response = $this->actingAs($admin)->post('/admin/tasks', [
            'title'          => $title,
            'description'    => 'New Task Created From Testing',
            'assigned_by_id' => $admin->id,
            'assigned_to_id' => $user->id,
        ]);

        $response->assertRedirectToRoute('admin.tasks.index');
        $response->assertStatus(302);
        $this->assertDatabaseHas('tasks', [
            'title'          => $title,
            'description'    => 'New Task Created From Testing',
            'assigned_by_id' => $admin->id,
            'assigned_to_id' => $user->id,
        ]);
    }
}
