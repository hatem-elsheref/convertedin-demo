<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Select2UserResource;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(private readonly UserService $userService){}

    public function index(Request $request, $type)
    {
        if ($request->ajax())
            return response()->json(new Select2UserResource($this->userService->list($request, $type)));

        abort(404);
    }
}
