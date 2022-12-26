<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AddressController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//  Usuario
Route::prefix('user')->group(function () {
    Route::get('/list', [UserController::class, 'index'])->name('user.list');
    Route::put('/edit', [UserController::class, 'update'])->name('user.edit');
    Route::post('/save', [UserController::class, 'store'])->name('user.save');
    Route::delete('/remove', [UserController::class, 'destroy'])->name('user.remove');
});

//  Endereço
Route::prefix('address')->group(function () {
    Route::get('/list', [AddressController::class, 'index'])->name('address.list');
    Route::put('/edit', [AddressController::class, 'update'])->name('address.edit');
    Route::post('/save', [AddressController::class, 'store'])->name('address.save');
});
