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
Route::get('/logout', [LoginController::class,'logout'])->name('logout');
Route::view('/forgot-password','auth.forgot-password')->name('forgot-password');

Route::post('/user/register',[RegisterController::class,'store'])->name('user.register');
Route::post('/user/authentication',[LoginController::class,'authenticate'])->name('authentication');

Route::get('/user/dashboard/{id}',[UserController::class,'dashboard'])->name('user.dashboard');

Route::get('/user/{id}/notes/list',[NoteController::class,'list'])->name('notes.list');

Route::get('/user/{id}/notes/{Note:id}/show',[NoteController::class,'show'])->name('notes.show');


Route::delete('/user/notes', [NoteController::class, 'destroy'])->name('notes.destroy');

Route::get('/user/{user}/notes/create', [NoteController::class, 'create'])->name('notes.create');
Route::post('/user/{user}/notes', [NoteController::class, 'store'])->name('notes.store');

Route::get('/user/{user}/notes/{note}/edit', [NoteController::class, 'edit'])->name('notes.edit');
Route::put('/user/{user}/notes', [NoteController::class, 'store'])->name('notes.update');


// Route::get('/user/{id}/notes/create', [NoteController::class, 'create'])->name('notes.create');

// Route::get('/user/{user}/notes/{note}/edit', [NoteController::class, 'edit'])->name('notes.edit');

// Route::post('/user/{user}/notes/{note}', [NoteController::class, 'store'])->name('notes.store');
// Route::put('/user/{user}/notes/{note}', [NoteController::class, 'update'])->name('notes.update');

// Route::post('/user/{id}/notes/store',[NoteController::class,'store'])->name('notes.store');

// Route::post('/user/notes/uploads',[NoteController::class,'upload'])->name('notes.uploads');
// Route::put('/user/{id}/notes/{Note:id}', [NoteController::class, 'update'])->name('notes.update');
// Route::delete('/user/{id}/notes/{Note:id}', [NoteController::class, 'destroy'])->name('notes.destroy');

// Route::delete('/user/notes/{Note:id}', [NoteController::class, 'destroy'])->name('notes.destroy');
