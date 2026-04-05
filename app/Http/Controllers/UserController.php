<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

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

    public function profile() {
        return view('Profile.profile', ['user' => Auth::user()]);
    }

    public function editProfile() {

        if (Gate::allows('isUser') || Gate::allows('isSeller')) {
            return view('Profile.editProfile', ['user' => Auth::user()]);
        } else {
            abort(403);
        }
    }

    public function updateProfile() {
        $user = request()->validate([
          'email' => 'required',
          'firstName' => 'required',
          'lastName' => 'required'
        ]);

        $this->userService->updateUser($user);
        return redirect('/profile');
    }

    public function authenticateUser() {
        $user = request()->validate([
          'email' => 'required',
          'password' => 'required'  
        ]);
        
        if(!Auth::attempt($user)) {
            throw ValidationException::withMessages([
                'email' => 'Sorry email does not match',
                'password' => 'Wrong password'
            ]);
        }

        request()->session()->regenerate();
        return redirect('/');
    }

    public function createUser() {
        $user = request()->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => ['required', 'email', Rule::unique('users')->ignore(Auth::id())],
            'password' => ['required', Password::min(7)->numbers()->letters()]
        ], [
            'email.required' => 'Email is required.',
            'email.email' => 'Enter a valid email format.',
            'email.unique' => 'This email is already taken.',

            'password.min' => 'Password must be at least 7 characters.',
            'password.letters' => 'Password must contain letters.',
            'password.numbers' => 'Password must contain numbers.',
        ]);

        $this->userService->createUser($user);
        return redirect('/login');
    }

    public function logout() {
        $this->userService->logOut();
        return redirect('/');
    }
}
