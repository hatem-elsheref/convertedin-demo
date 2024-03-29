<?php

namespace Database\Seeders;

use App\Enums\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $chunkSize = 5000;
        $users     = [];
        $now       = now()->toDateTimeString();
        $password  = bcrypt(12345678);

        for ($iteration = 1; $iteration <= 10000; $iteration++){

            $users[] =  [
                'name'              => "User $iteration",
                'email'             => "user_{$iteration}@converted.in",
                'role'              => Role::USER->value,
                'email_verified_at' => $now,
                'password'          => $password,
                'remember_token'    => null,
                'created_at'        => $now,
                'updated_at'        => $now,
            ];

            if (count($users) >= $chunkSize){
                DB::table('users')->insert($users);
                $users = [];
            }
        }

    }
}
