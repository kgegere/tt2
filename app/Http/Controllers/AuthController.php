<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegister()
    {
        if(Auth::check()) 
        {
            return redirect()->route('listing.index');
        }
        return view('auth.register');
    }

    public function showLogin()
    {
        if(Auth::check()) 
        {
            return redirect()->route('listing.index');
        }
        return view('auth.login');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'address' => 'required|string|max:255',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'address' => $validated['address'],
        ]);

        Auth::login($user);

        return redirect()->route('listing.index');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if(Auth::attempt($credentials)) 
        {
            $request->session()->regenerate();
            return redirect('/');
        }
        else
        {
            return back()->withErrors([
                'email' => __('validation.wrong_credentials'),
            ])->onlyInput('email');
        }
    }

    public function logout(Request $request)
    {
        $locale = session('locale', config('app.locale')); 

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $request->session()->put('locale', $locale);

        return redirect()->back();
    }
}
