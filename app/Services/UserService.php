<?php

namespace App\Services;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class UserService
{
    public function list($request, $role) :LengthAwarePaginator
    {
        return User::query()
            ->select('id', 'name')
            ->where('role', $role === 'user' ? Role::USER->value : Role::ADMIN->value)
            ->where('name', 'LIKE', "%".$request->query('q')."%")
            ->paginate(10);
    }
}
