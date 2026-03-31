<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class UserService
{
    public function authenticateUser($user) {
        if(!Auth::attempt($user)) {
            throw ValidationException::withMessages([
                'email' => 'Sorry email does not match',
                'password' => 'Wrong password'
            ]);
        }
    }

    public function createUser($user) {
        $user = User::create($user);
    }

    public function logOut() {
        Auth::logout();
    }
}
