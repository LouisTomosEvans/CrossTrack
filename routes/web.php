<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
Use Laravel\Sanctum\HasApiTokens;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('https://huntintel.io/');
});

Route::middleware(['auth:sanctum', 'verified', 'subscribed'])->get('/knowledge-base', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified', 'subscribed'])->get('/location-tools', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified', 'subscribed'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/profile', function () {
    return view('profile/show');
})->name('profile');

Route::get('/logout', function () {
    auth()->logout();
    return view('auth/login');
})->name('logout');


