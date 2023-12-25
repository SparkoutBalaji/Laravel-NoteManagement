<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


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

        // $credentials = $request->only('email','password');

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user(); // Get the authenticated user

            // Redirect to the user's dashboard based on their ID
            return redirect()->route('user.dashboard', ['id' => $user->id]);
        } else {
            return redirect()->back()->withInput($request->only('email'))->with(['fail' => 'The provided credentials do not match our records.']);
        }
    }
    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
