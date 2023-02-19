<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

// Plan
Route::middleware(['auth:sanctum'])->get('/plan', [AppController::class, 'plan'])->name('plan');

// Dashboard
Route::middleware(['auth:sanctum', 'verified'])->get('/app', [AppController::class, 'index'])->name('app');

// Teams
Route::group(['prefix' => 'teams'], function()
{
    Route::middleware(['auth:sanctum', 'verified'])->get('/', [App\Http\Controllers\TeamController::class, 'index'])->name('teams.index');
    Route::middleware(['auth:sanctum', 'verified'])->get('create', [App\Http\Controllers\TeamController::class, 'create'])->name('teams.create');
    // Route::middleware(['auth:sanctum', 'verified'])->post('teams', [App\Http\Controllers\TeamController::class, 'store'])->name('teams.store');

    Route::middleware(['TeamOwner', 'auth:sanctum', 'verified'])->get('edit/{id}', [App\Http\Controllers\TeamController::class, 'edit'])->name('teams.edit');
    Route::middleware(['auth:sanctum', 'verified'])->put('edit/{id}', [App\Http\Controllers\TeamController::class, 'update'])->name('teams.update');
    Route::middleware(['TeamOwner', 'auth:sanctum', 'verified'])->delete('destroy/{id}', [App\Http\Controllers\TeamController::class, 'destroy'])->name('teams.destroy');
    Route::middleware(['auth:sanctum', 'verified'])->get('switch/{id}', [App\Http\Controllers\TeamController::class, 'switchTeam'])->name('teams.switch');

    Route::middleware(['auth:sanctum', 'verified'])->get('members/{id}', [App\Http\Controllers\TeamMemberController::class, 'show'])->name('teams.members.show');
    Route::middleware(['TeamOwner', 'auth:sanctum', 'verified'])->put('members/{id}/{user_id}', [App\Http\Controllers\TeamMemberController::class, 'updateStatus'])->name('teams.members.update.status');
    Route::middleware(['TeamOwner', 'auth:sanctum', 'verified'])->get('members/resend/{invite_id}', [App\Http\Controllers\TeamMemberController::class, 'resendInvite'])->name('teams.members.resend_invite');
    Route::middleware(['TeamOwner', 'auth:sanctum', 'verified'])->post('members/{id}', [App\Http\Controllers\TeamMemberController::class, 'invite'])->name('teams.members.invite');
    Route::middleware(['TeamOwner', 'auth:sanctum', 'verified'])->delete('members/{id}/{user_id}', [App\Http\Controllers\TeamMemberController::class, 'destroy'])->name('teams.members.destroy');
    Route::middleware(['TeamOwner', 'auth:sanctum', 'verified'])->delete('invitation/{id}/{invite_id}', [App\Http\Controllers\InvitesController::class, 'destroy'])->name('teams.invites.destroy');

    // middleware routes
    Route::middleware(['auth:sanctum', 'verified'])->post('teams', [App\Http\Controllers\TeamController::class, 'storeBlocked'])->name('teams.store.block');

    // join team deny team
    Route::middleware(['auth:sanctum', 'verified'])->get('join/{team_id}/{user_id}', [App\Http\Controllers\TeamMemberController::class, 'joinTeam'])->name('teams.join');
    Route::middleware(['auth:sanctum', 'verified'])->get('deny/{team_id}/{user_id}', [App\Http\Controllers\TeamMemberController::class, 'denyTeam'])->name('teams.deny');

    // websites
    Route::middleware(['auth:sanctum', 'verified'])->get('websites/{id}', [App\Http\Controllers\WebsiteController::class, 'index'])->name('websites.show');
    Route::middleware(['auth:sanctum', 'verified'])->post('websites/{id}', [App\Http\Controllers\WebsiteController::class, 'store'])->name('websites.show');
    Route::middleware(['auth:sanctum', 'verified'])->put('websites/{id}/{website_id}', [App\Http\Controllers\WebsiteController::class, 'updateStatus'])->name('teams.website.update.status');


});

Route::middleware(['auth:sanctum', 'verified'])->delete('members/leave/{id}', [App\Http\Controllers\TeamMemberController::class, 'leaveTeam'])->name('teams.members.leave');
Route::get('teams/accept/{token}', [App\Http\Controllers\AuthController::class, 'acceptInvite'])->name('teams.accept_invite');