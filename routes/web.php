<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\User\NoteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;

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
Route::get('/',[LoginController::class,'login'])->name('login');
Route::view('/register','auth.register')->name('register');
Route::view('/forgot-password','auth.forgot-password')->name('forgot-password');

Route::post('/user/register',[RegisterController::class,'store'])->name('user.register');
Route::post('/user/authentication',[LoginController::class,'authenticate'])->name('authentication');

Route::get('/user/dashboard/{id}',[UserController::class,'dashboard'])->name('user.dashboard');

Route::get('/user/{id}/notes/create',[NoteController::class,'create'])->name('notes.create');
