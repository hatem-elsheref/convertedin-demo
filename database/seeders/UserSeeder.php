<?php

namespace Database\Seeders;

use App\Enums\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
            if (count($users) === $chunkSize){
                DB::table('users')->insert($users);
                $users = [];
            }

            $users[] =  [
                'name'              => "User $iteration",
                'email'             => "user_{$iteration}@converted.in",
                'role'              => Role::user->value,
                'email_verified_at' => $now,
                'password'          => $password,
                'remember_token'    => null,
                'created_at'        => $now,
                'updated_at'        => $now,
            ];
        }

    }
}
