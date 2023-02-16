<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
Use Laravel\Sanctum\HasApiTokens;
use App\Models\User;
use App\Http\Controllers\AuthController;

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
    return redirect('https://leadrhino.webflow.io');
});

Route::get('member/register/{token}', [AuthController::class, 'create'])->name('member/register');

Route::middleware(['auth:sanctum', 'verified', 'checkActiveTeam', 'subscribed'])->get('/team', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified', 'checkActiveTeam', 'subscribed'])->get('/company', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified', 'checkActiveTeam', 'subscribed'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::middleware(['auth:sanctum', 'verified', 'checkActiveTeam'])->get('/profile', function () {
    return view('profile/show');
})->name('profile');

Route::get('/logout', function () {
    auth()->logout();
    return view('auth/login');
})->name('logout');

// teams create page
Route::middleware(['auth:sanctum', 'verified', 'checkNotActiveTeam'])->get('/teams/create', function () {
    return view('teams/create');
})->name('teams.create');
