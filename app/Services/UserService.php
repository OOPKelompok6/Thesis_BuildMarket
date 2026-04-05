<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class UserService
{

    public function createUser($user) {
        $user = User::create($user);
    }

    public function updateUser($user) {
        $curUser = Auth::user();
        $curUser->firstName = $user['firstName'];
        $curUser->lastName = $user['lastName'];
        $curUser->email = $user['email'];

        $curUser->save();
    }

    public function logOut() {
        Auth::logout();
    }
}
