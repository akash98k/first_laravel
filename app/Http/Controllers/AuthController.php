<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('admin.login');
        // if (Auth::guest()) {
        //     return view('admin.login');
        // }else{
        //     return view('admin.dashboard');
        // }
    }

    public function authenticate(Request $request)
    {
        $creadentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($creadentials)) {
            return redirect()->route('dashboard');
        }else{
            return redirect()->route('login');
        }
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function logout()
    {
        return view('admin.logout');
    }

    public function register()
    {
        return view('admin.register');
        // if (Auth::guest()) {
        //     return view('admin.register');
        // }else{
        //     return view('admin.dashboard');
        // }
    }
}
