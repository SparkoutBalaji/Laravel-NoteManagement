<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\User\NoteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\User\ForgotPasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['guest'])->group(function () {
    Route::get('/', function () {
        if (Auth::guard('users')->check()) {
            Auth::guard('users')->user();
            return redirect()->route('user.dashboard');
        }
        return view('auth.login');
    })->name('login');
    Route::get('/', [LoginController::class, 'login'])->name('login');
    Route::view('/register', 'auth.register')->name('register');
    Route::post('/user/register', [RegisterController::class, 'store'])->name('user.register');
    Route::post('/user/authentication', [LoginController::class, 'authenticate'])->name('authentication');
});
Route::middleware(['auth:users'])->group(function () {
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::view('/forgot-password', 'auth.forgot-password')->name('forgot-password');

Route::get('/user/dashboard ', [UserController::class, 'dashboard'])->name('user.dashboard');

Route::get('/user/category/notes',[NoteController::class,'category'])->name('notes.category');

Route::get('/user/notes/list', [NoteController::class, 'list'])->name('notes.list');

Route::delete('/user/notes', [NoteController::class, 'destroy'])->name('notes.destroy');

Route::get('/user/notes/create', [NoteController::class, 'create'])->name('notes.create');
Route::post('/user/notes', [NoteController::class, 'store'])->name('notes.store');

Route::post('/user/notes/edit', [NoteController::class, 'edit'])->name('notes.edit');
Route::put('/user/notes', [NoteController::class, 'store'])->name('notes.update');
});
// Route::post('/user/notes/uploads',[NoteController::class,'upload'])->name('notes.uploads');

//Forgot Password
Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');

Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');

Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');

Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
