<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthSocialController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
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



// Rotas Autenticadas
//Route::middleware(['jwt-authenticated'])->group(callback: function () {

    //  Autenticação
    Route::prefix('auth')->group(function () {
        // Social
        Route::get('/login/social/{provider}', [AuthSocialController::class, 'redirectToProvider'])->name('social.login');
        Route::get('/login/social/{provider}/callback', [AuthSocialController::class, 'handleProviderCallback'])->name('social.callback');

        // Trandicional
        Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
        Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout')->middleware('jwt-authenticated');
        Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('auth.forgot');
        Route::post('/refresh-password', [AuthController::class, 'refreshPassword'])->name('auth.refresh');
    });

    //  Endereço
    Route::prefix('address')->group(function () {
        Route::get('/list/uf', [AddressController::class, 'index'])->name('address.uf.list');
        Route::put('/edit', [AddressController::class, 'update'])->name('address.edit')->middleware('jwt-authenticated');
        Route::post('/save', [AddressController::class, 'store'])->name('address.save');
    });

    //  Categoria
    Route::prefix('category')->group(function () {
        Route::get('/list', [CategoryController::class, 'index'])->name('category.list.all');
        Route::get('/list/find', [CategoryController::class, 'show'])->name('category.list.find')->middleware('jwt-authenticated');
        Route::put('/edit', [CategoryController::class, 'update'])->name('category.edit')->middleware('jwt-authenticated');
        Route::post('/save', [CategoryController::class, 'store'])->name('category.save')->middleware('jwt-authenticated');
    });

    //  Pedido
    Route::prefix('order')->group(function () {
        Route::get('/list', [OrderController::class, 'index'])->name('order.list.all')->middleware('jwt-authenticated');
        Route::get('/list/find', [OrderController::class, 'show'])->name('order.list.find')->middleware('jwt-authenticated');
        Route::post('/save', [OrderController::class, 'store'])->name('order.save')->middleware('jwt-authenticated');
    });

    //  Pagamento
    Route::prefix('payment')->group(function () {
        Route::post('/save', [PaymentController::class, 'store'])->name('payment.save')->middleware('jwt-authenticated');
    });

    //  Produto
    Route::prefix('product')->group(function () {
        Route::get('/list', [ProductController::class, 'index'])->name('product.list.all');
        Route::get('/list/find', [ProductController::class, 'show'])->name('product.list.find');
        Route::put('/edit', [ProductController::class, 'update'])->name('product.edit')->middleware('jwt-authenticated');
        Route::post('/save', [ProductController::class, 'store'])->name('product.save')->middleware('jwt-authenticated');
    });

    // Fornecedor
    Route::prefix('provider')->group(function () {
        Route::get('/list', [ProviderController::class, 'index'])->name('provider.list.all')->middleware('jwt-authenticated');
        Route::get('/list/find', [ProviderController::class, 'show'])->name('provider.list.find')->middleware('jwt-authenticated');
        Route::put('/edit', [ProviderController::class, 'update'])->name('provider.edit')->middleware('jwt-authenticated');
        Route::post('/save', [ProviderController::class, 'store'])->name('provider.save')->middleware('jwt-authenticated');
    });

    //  Telefone
    Route::prefix('telephone')->group(function () {
        Route::get('/list/ddd', [TelephoneController::class, 'index'])->name('telephone.ddd.list');
        Route::put('/edit', [TelephoneController::class, 'update'])->name('telephone.edit')->middleware('jwt-authenticated');
        Route::post('/save', [TelephoneController::class, 'store'])->name('telephone.save');
    });

    //  Usuario
    Route::prefix('user')->group(function () {
        Route::get('/email-verified/{id}', [UserController::class, 'emailVerifiedAt'])->name('user.email.verified');
        Route::get('/list', [UserController::class, 'index'])->name('user.list.all')->middleware('jwt-authenticated');
        Route::get('/list/find', [UserController::class, 'show'])->name('user.list.find')->middleware('jwt-authenticated');
        Route::put('/edit', [UserController::class, 'update'])->name('user.edit')->middleware('jwt-authenticated');
        Route::post('/save', [UserController::class, 'store'])->name('user.save');
    });
//});
