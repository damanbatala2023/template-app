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


        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $confirm_password = $request->input('confirm_password');

        // Perform validation checks
        if (!$name || !$email || !$password || !$confirm_password) {
            return "Please fill in all fields.";
        }
        if ($password != $confirm_password) {
            return redirect()->back()->withErrors([
                'confirm_password' => 'Password does not match.',
            ]);
        }

        // Save the user's information to the database
        $user = new User;
        $user->name = $name;
        $user->email = $email;
        $user->password = bcrypt($password);
        $user->save();

        return redirect('/login')->withSuccess("User registered successfully!");
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
