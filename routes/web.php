<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Auth\LoginRegisterController;

Route::get('/login', 'login')->name('login');
Route::get('/register', 'register')->name('register');
Route::post('/authenticate', 'authenticate')->name('authenticate');


Route::controller(LoginRegisterController::class)->group(function() {
    Route::resource('posts', PostController::class);
    Route::post('/store', 'store')->name('store');
    Route::get('/home', 'home')->name('home');
    Route::get('/logout', 'logout')->name('logout');
});