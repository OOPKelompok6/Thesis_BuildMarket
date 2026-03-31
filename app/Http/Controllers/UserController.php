<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{


    public function __construct(protected UserService $userService)
    {}

    public function login() {
        return view('Auth.login');
    }

    public function register() {
        return view('Auth.register');
    }

    public function authenticateUser() {

        $user = request()->validate([
          'email' => 'required',
          'password' => 'required'  
        ]);
        $this->userService->authenticateUser($user);

        request()->session()->regenerate();
        return redirect('/');
    }

    public function createUser() {
        $user = request()->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => ['required'],
            'password' => ['required', Password::min(7)->numbers()->letters()]
        ]);

        $this->userService->createUser($user);
        return redirect('/login');
    }

    public function logout() {
        $this->userService->logOut();
        return redirect('/');
    }
}
