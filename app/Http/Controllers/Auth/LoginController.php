<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class LoginController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('users')->attempt($credentials)) {
            // $user = Auth::guard('users')->user();
            // // dd($user);
            // Session::getId($user);
            return redirect()->route('notes.create');
        } else {
            return redirect()
                ->back()
                ->withInput($request->only('email'))
                ->with(['fail' => 'The provided credentials do not match our records.']);
        }
    }


    public function logout()
    {
        Session::flush();
        Auth::guard('users')->logout();
        return redirect()->route('login');
    }
}
