<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\TelephoneController;
use App\Http\Controllers\UserController;

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

//  Endereço
Route::prefix('address')->group(function () {
    Route::get('/uf/list', [AddressController::class, 'uf'])->name('address.uf.list');
    Route::get('/list', [AddressController::class, 'index'])->name('address.list');
    Route::put('/edit', [AddressController::class, 'update'])->name('address.edit');
    Route::post('/save', [AddressController::class, 'store'])->name('address.save');
    Route::delete('/remove', [AddressController::class, 'destroy'])->name('address.remove');
});

// Fornecedor
Route::prefix('provider')->group(function () {
    Route::get('/list', [ProviderController::class, 'index'])->name('provider.list');
    Route::put('/edit', [ProviderController::class, 'update'])->name('provider.edit');
    Route::post('/save', [ProviderController::class, 'store'])->name('provider.save');
    Route::delete('/remove', [ProviderController::class, 'destroy'])->name('provider.remove');
});

//  Telefone
Route::prefix('telephone')->group(function () {
    Route::get('/ddd/list', [TelephoneController::class, 'ddd'])->name('telephone.ddd.list');
    Route::get('/list', [TelephoneController::class, 'index'])->name('telephone.list');
    Route::put('/edit', [TelephoneController::class, 'update'])->name('telephone.edit');
    Route::post('/save', [TelephoneController::class, 'store'])->name('telephone.save');
    Route::delete('/remove', [TelephoneController::class, 'destroy'])->name('telephone.remove');
});

//  Usuario
Route::prefix('user')->group(function () {
    Route::get('/list', [UserController::class, 'index'])->name('user.list');
    Route::get('/list/{id}', [UserController::class, 'show'])->name('user.list.find');
    Route::put('/edit/{id}', [UserController::class, 'update'])->name('user.edit');
    Route::post('/save', [UserController::class, 'store'])->name('user.save');
    Route::delete('/remove/{id}', [UserController::class, 'destroy'])->name('user.remove');
});
