<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\UserService;

class UserController extends Controller
{
    public function __construct(protected UserService $userService)
    {}

    public function getCurrentUser()
    {
        return response()->json($this->userService->getCurrentUser(), 200);
    }
}
