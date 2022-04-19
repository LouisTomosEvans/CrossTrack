<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;
use App\Http\Controllers\MapSearchController;
use App\Http\Controllers\TwitterSearchController;
use App\Http\Controllers\MetaPlaceSearchController;
use App\Http\Controllers\MetaPlaceController;
use App\Http\Controllers\VKPhotoSearchController;
use App\Http\Controllers\VKPhotoController;
use App\Http\Controllers\VKKeyController;
use App\Http\Controllers\IPAddressController;


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

// Location
Route::middleware(['auth:sanctum', 'verified'])->post('/mapsearch/create', [MapSearchController::class, 'create'])->name('mapsearch.create');


// Location Twitter
Route::middleware(['auth:sanctum', 'verified'])->post('/twittersearch/create', [TwitterSearchController::class, 'create'])->name('twittersearch.create');


// Location Meta
Route::middleware(['auth:sanctum', 'verified'])->post('/metaplacesearch/create', [MetaPlaceSearchController::class, 'create'])->name('metaplacesearch.create');
Route::middleware(['auth:sanctum', 'verified'])->post('/metaplace/create', [MetaPlaceController::class, 'create'])->name('metaplace.create');


// Location VK
Route::middleware(['auth:sanctum', 'verified'])->post('/vkphotosearch/create', [VKPhotoSearchController::class, 'create'])->name('vkphotosearch.create');
Route::middleware(['auth:sanctum', 'verified'])->post('/vkphoto/create', [VKPhotoController::class, 'create'])->name('vkphoto.create');
Route::middleware(['auth:sanctum', 'verified'])->get('/vkphoto/{id}', [VKPhotoController::class, 'index'])->name('vkphoto.index');


// VK Key
Route::middleware(['auth:sanctum', 'verified'])->post('/vkkey/store', [VKKeyController::class, 'store'])->name('vkkey.store');
Route::middleware(['auth:sanctum', 'verified'])->get('/vkkey/index', [VKKeyController::class, 'index'])->name('vkkey.index');

// IP Addresses
Route::middleware(['auth:sanctum', 'verified'])->post('/ipaddress/create', [IPAddressController::class, 'create'])->name('ipaddress.create');
Route::middleware(['auth:sanctum', 'verified'])->get('/ipaddress/{id}', [IPAddressController::class, 'index'])->name('ipaddress.index');
