<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function loginView() {
        return view('login');
    }

    public function signupView() {
        return view('signup');
    }

    public function login(Request $request){
        $body = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        if (auth()->guard('web')->attempt(['email' => $body['email'],'password'=> $body['password']])) {
            $request->session()->regenerate();
            return redirect('/dashboard');
        } else {
            return back()->withErrors(['all' => 'Incorrect credentials'])->withInput();
        }
    }

    public function signup(Request $request) {
        $body = $request->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required','min:3', 'max:255'],
            'confirmPassword' => ['required', 'min:3', 'max:255'],
        ]);

        if ($body['password'] !== $body['confirmPassword']) {
            return back()->withErrors(['all' => 'Passwords do not match'])->withInput();
        }

        $body['password'] = bcrypt($body['password']);
        $user = User::create($body);
        auth()->guard('web')->login($user);

        return redirect('/dashboard');
    }

    public function logout() {
        auth()->guard('web')->logout();
        return redirect('/login');
    }
}