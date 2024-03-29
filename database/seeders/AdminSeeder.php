<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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

        /*
        $admins = User::factory(100)
            ->sequence(fn($sequence) => ['email' => "admin_{$sequence->index}@converted.in"])
            ->admin()->make()->toArray();

        User::query()->insertOrIgnore($admins);
        */

        $chunkSize = 100;
        $admins    = [];
        $now       = now()->toDateTimeString();
        $password  = bcrypt(12345678);

        for ($iteration = 1; $iteration <= 100; $iteration++){

            $admins[] =  [
                'name'              => "Admin $iteration",
                'email'             => "admin_{$iteration}@converted.in",
                'role'              => Role::ADMIN->value,
                'email_verified_at' => $now,
                'password'          => $password,
                'remember_token'    => null,
                'created_at'        => $now,
                'updated_at'        => $now,
            ];

            if (count($admins) >= $chunkSize){
                DB::table('users')->insert($admins);
                $admins = [];
            }
        }

    }
}
