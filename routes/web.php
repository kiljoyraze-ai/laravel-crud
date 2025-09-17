<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Auth\LoginRegisterController;

// Rute utama akan mengarahkan ke halaman beranda.
// Middleware otentikasi akan mengurus pengalihan ke halaman login jika diperlukan.
Route::get('/', function () {
    return redirect()->route('home');
});

// Gunakan Route::controller() untuk mengelompokkan rute-rute otentikasi.
// Ini adalah cara terbaik untuk menghubungkan rute ke controller.
Route::controller(LoginRegisterController::class)->group(function(){
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::post('/logout', 'logout')->name('logout');
    Route::get('/home', 'home')->name('home'); // Rute ini tidak perlu di dalam grup terpisah
});

// Tentukan rute resource untuk posts dengan middleware otentikasi.
Route::resource('posts', PostController::class)->middleware('auth');
 