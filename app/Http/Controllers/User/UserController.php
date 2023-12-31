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
        $user = Auth::guard('users')->user();

        $userCategories = $user->category;

        return view('user.dashboard', compact('user','userCategories'));
    }

}
