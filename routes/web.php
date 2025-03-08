<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('admin.dashboard');
});

Route::get('',[AuthController::class, 'dashboard'])->name('dashboard');
Route::get('/login',[AuthController::class, 'login'])->name('login');
Route::post('/loginAuthenticate', [AuthController::class, 'authenticate'])->name('authenticate');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Route::get('/register', function(){
//     return view('admin.register');
// });

// Route::get('/register', function(){
//     return view('admin.register');
// });