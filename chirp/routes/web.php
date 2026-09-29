<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChirpController;
use App\Http\Controllers\Auth\Register;
use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Auth\Logout;

Route::get('/', [ChirpController::class, 'index']);
Route::view('/register', 'auth.register')->middleware('guest')->name('register');
Route::post('/register', Register::class)->middleware('guest');

Route::view('/login', 'auth.login')->middleware('guest')->name('login');
Route::post('/login', Login::class)->middleware('guest');
Route::post('/logout', Logout::class)->middleware('auth')->name('logout');

Route::middleware(['auth'])->group(function() {
    Route::resource('chirps', ChirpController::class)->only(['store', 'edit', 'update', 'destroy']);
});

// Route::post('/chirps', [ChirpController::class, 'store']);
// Route::get('chirp/{chirp}/edit', [ChirpController::class, 'edit']);
// Route::put('chirp/{chirp}', [ChirpController::class, 'update']);
// Route::delete('chirp/{chirp}', [ChirpController::class, 'destroy']);
