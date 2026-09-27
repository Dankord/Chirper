<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChirpController;
use App\Http\Controllers\Auth\Register;

Route::get('/', [ChirpController::class, 'index']);
Route::view('/register', 'auth.register')->middleware('guest')->name('register');
Route::post('/register', Register::class)->middleware('guest');
Route::middleware('auth')->group(function() {
    Route::resource('chirps', ChirpController::class)->only(['store', 'edit', 'update', 'destroy']);
});

// Route::post('/chirps', [ChirpController::class, 'store']);
// Route::get('chirp/{chirp}/edit', [ChirpController::class, 'edit']);
// Route::put('chirp/{chirp}', [ChirpController::class, 'update']);
// Route::delete('chirp/{chirp}', [ChirpController::class, 'destroy']);
