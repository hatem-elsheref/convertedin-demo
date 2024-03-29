<?php

namespace App\Services;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserService
{
    public function listAllUsers(): Collection
    {
        return User::query()->select('id', 'name')->where('role', Role::USER->value)->get();
    }

    public function listAllAdmins(): Collection
    {
        return User::query()->select('id', 'name')->where('role', Role::ADMIN->value)->get();
    }
}
