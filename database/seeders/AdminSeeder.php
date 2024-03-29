<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name'  => 'Hatem Mohamed',
            'email' => 'hatem.mohamed@converted.in',
            'role'  => Role::ADMIN->value
        ]);

        User::factory()->create([
            'name'  => 'Amr Ramadan',
            'email' => 'a.ramadan@converted.in',
            'role'  => Role::ADMIN->value
        ]);

        $admins = User::factory(100)
            ->sequence(fn($sequence) => ['email' => "admin_{$sequence->index}@converted.in"])
            ->admin()->make()->toArray();

        User::query()->insertOrIgnore($admins);
    }
}
