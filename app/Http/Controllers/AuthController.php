<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;



class AuthController extends Controller
{
    public function getLogin()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {


        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            // Authentication passed
            return redirect()->intended('/dashboard');
        }

        // Authentication failed
        return redirect()->back()->withErrors([
            'email' => 'Invalid login credentials.',
        ]);
    }

    public function getRegister()
    {
        return view('auth.register');
    }

    public function postRegister(Request $request)
    {


        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        Auth::login($user);

        return redirect('/login');
    }

    // Logout the user
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function getDashboard()
    {
        return view('page.dashboard');
    }
}
