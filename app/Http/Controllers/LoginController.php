<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Validator;
use function back;
use function redirect;

class LoginController extends Controller
{
    public static function authenticate($credentials)
    {
        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
            return redirect()->intended('test');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public static function login($credentials): RedirectResponse|Redirector
    {
        if (Auth::attempt($credentials)) {
            return redirect('/dashboard');
        }
        return back()->withErrors(['password' => 'Invalid Student Number or Password']);
    }

    public static function register($credentials)
    {
        $validator = Validator::make($credentials, [
            's_number' => 'required|string|regex:/[s,t,S,T]_\d+/', //Allow for t_ and s_ numbers
            'email' => 'required|email',
            'name' => 'required|string',
            'password' => 'required|string'
        ], [ // Custom Error Messages
            's_number.regex' => '"S_" Prefix Required eg: S_123456',
        ]);
        $validated = $validator->validated();

        User::create($validated);
        return LoginController::login($credentials);
    }
}
