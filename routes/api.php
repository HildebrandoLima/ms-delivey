<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
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
    Route::get('/list', [AddressController::class, 'uf'])->name('address.uf.list');
    Route::get('/list/{id}', [AddressController::class, 'index'])->name('address.list');
    Route::put('/edit/{id}', [AddressController::class, 'update'])->name('address.edit');
    Route::post('/save', [AddressController::class, 'store'])->name('address.save');
    Route::delete('/remove/{id}', [AddressController::class, 'destroy'])->name('address.remove');
});

//  Categoria
Route::prefix('category')->group(function () {
    Route::get('/list', [CategoryController::class, 'index'])->name('category.list.all');
    Route::get('/list/{id}', [CategoryController::class, 'show'])->name('category.list.find');
    Route::put('/edit/{id}', [CategoryController::class, 'update'])->name('category.edit');
    Route::post('/save', [CategoryController::class, 'store'])->name('category.save');
    Route::delete('/remove/{id}', [CategoryController::class, 'destroy'])->name('category.remove');
});

//  Produto
Route::prefix('product')->group(function () {
    Route::get('/list', [ProductController::class, 'index'])->name('product.list.all');
    Route::get('/list/{id}', [ProductController::class, 'show'])->name('product.list.find');
    Route::put('/edit/{id}', [ProductController::class, 'update'])->name('product.edit');
    Route::post('/save', [ProductController::class, 'store'])->name('product.save');
    Route::delete('/remove/{id}', [ProductController::class, 'destroy'])->name('product.remove');
});

// Fornecedor
Route::prefix('provider')->group(function () {
    Route::get('/list', [ProviderController::class, 'index'])->name('provider.list.all');
    Route::get('/list/{id}', [ProviderController::class, 'show'])->name('provider.list.find');
    Route::put('/edit/{id}', [ProviderController::class, 'update'])->name('provider.edit');
    Route::post('/save', [ProviderController::class, 'store'])->name('provider.save');
    Route::delete('/remove/{id}', [ProviderController::class, 'destroy'])->name('provider.remove');
});

//  Telefone
Route::prefix('telephone')->group(function () {
    Route::get('/list', [TelephoneController::class, 'ddd'])->name('telephone.ddd.list');
    Route::get('/list/{id}', [TelephoneController::class, 'index'])->name('telephone.list');
    Route::put('/edit/{id}', [TelephoneController::class, 'update'])->name('telephone.edit');
    Route::post('/save', [TelephoneController::class, 'store'])->name('telephone.save');
    Route::delete('/remove/{id}', [TelephoneController::class, 'destroy'])->name('telephone.remove');
});

//  Usuario
Route::prefix('user')->group(function () {
    Route::get('/list', [UserController::class, 'index'])->name('user.list.all');
    Route::get('/list/{id}', [UserController::class, 'show'])->name('user.list.find');
    Route::put('/edit/{id}', [UserController::class, 'update'])->name('user.edit');
    Route::post('/save', [UserController::class, 'store'])->name('user.save');
    Route::delete('/remove/{id}', [UserController::class, 'destroy'])->name('user.remove');
});
