<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;
use App\Http\Controllers\MapSearchController;
use App\Http\Controllers\TwitterSearchController;
use App\Http\Controllers\MetaPlaceSearchController;
use App\Http\Controllers\MetaPlaceController;


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

Route::middleware(['auth:sanctum', 'subscribed'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum', 'verified', 'subscribed'])->get('/app', [AppController::class, 'index'])->name('app');

Route::middleware(['auth:sanctum', 'verified', 'subscribed'])->post('/mapsearch/create', [MapSearchController::class, 'create'])->name('mapsearch.create');

Route::middleware(['auth:sanctum', 'verified', 'subscribed'])->post('/twittersearch/create', [TwitterSearchController::class, 'create'])->name('twittersearch.create');

Route::middleware(['auth:sanctum', 'verified', 'subscribed'])->post('/metaplacesearch/create', [MetaPlaceSearchController::class, 'create'])->name('metaplacesearch.create');

Route::middleware(['auth:sanctum', 'verified', 'subscribed'])->post('/metaplace/create', [MetaPlaceController::class, 'create'])->name('metaplace.create');
