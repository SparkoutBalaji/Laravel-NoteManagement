<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function dashboard()
    {
        // dd(Auth::guard('users')->user());
        // dd($user);
        // $userCategories = $user->category;

        return view('user.dashboard');
    }

}
