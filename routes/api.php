<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthSocialController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EmailVerifiedAt;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ItemController;
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



//  Autenticação
Route::prefix('auth')->group(function () {
    // Autenticação Social
    Route::get('/login/social/{provider}', [AuthSocialController::class, 'redirectToProvider'])->name('social.login');
    Route::get('/login/social/{provider}/callback', [AuthSocialController::class, 'handleProviderCallback'])->name('social.callback');

    // Autenticação Trandicional
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('auth.forgot');
    Route::post('/refresh-password/{token}', [AuthController::class, 'refreshPassword'])->name('auth.refresh');
});

// Usuário
Route::post('user/save', [UserController::class, 'store'])->name('user.save');

// Verificar cadastro de usuário e fornecedor
Route::get('/email-verified/save/{entity}', [EmailVerifiedAt::class, 'emailVerifiedAt'])->name('email.verified');

// Rotas Autenticadas
Route::middleware(['jwt-authenticated'])->group(callback: function () {

    //  Autenticação
    Route::post('auth/logout', [AuthController::class, 'logout'])->name('auth.logout');

    //  Endereço
    Route::prefix('address')->group(function () {
        Route::get('/list', [AddressController::class, 'index'])->name('address.list');
        Route::get('/list/uf', [AddressController::class, 'uf'])->name('address.uf.list');
        Route::put('/edit/{id}', [AddressController::class, 'update'])->name('address.edit');
        Route::post('/save', [AddressController::class, 'store'])->name('address.save');
        Route::put('/enable/disable', [AddressController::class, 'enableDisable'])->name('address.enable.disable');
    });

    //  Categoria
    Route::prefix('category')->group(function () {
        Route::get('/list', [CategoryController::class, 'index'])->name('category.list.all');
        Route::get('/list/find', [CategoryController::class, 'show'])->name('category.list.find');
        Route::put('/edit/{id}', [CategoryController::class, 'update'])->name('category.edit');
        Route::post('/save', [CategoryController::class, 'store'])->name('category.save');
        Route::put('/enable/disable', [CategoryController::class, 'enableDisable'])->name('category.enable.disable');
    });

    //  Imagem
    Route::prefix('image')->group(function () {
        Route::get('/list', [ImageController::class, 'index'])->name('image.list.all');
    });

    //  Item
    Route::prefix('item')->group(function () {
        Route::get('/list', [ItemController::class, 'index'])->name('item.list.all');
    });

    //  Pedido
    Route::prefix('order')->group(function () {
        Route::get('/list', [OrderController::class, 'index'])->name('order.list.all');
        Route::get('/list/find', [OrderController::class, 'show'])->name('order.list.find');
        Route::put('/edit/{id}', [OrderController::class, 'update'])->name('order.edit');
        Route::post('/save', [OrderController::class, 'store'])->name('order.save');
        Route::delete('/remove/{id}', [OrderController::class, 'destroy'])->name('order.remove');
    });

    //  Pagamento
    Route::prefix('payment')->group(function () {
        Route::post('/save', [PaymentController::class, 'store'])->name('payment.save');
    });

    //  Produto
    Route::prefix('product')->group(function () {
        Route::get('/list', [ProductController::class, 'index'])->name('product.list.all');
        Route::get('/list/find', [ProductController::class, 'show'])->name('product.list.find');
        Route::put('/edit/{id}', [ProductController::class, 'update'])->name('product.edit');
        Route::post('/save', [ProductController::class, 'store'])->name('product.save');
        Route::put('/enable/disable', [ProductController::class, 'enableDisable'])->name('product.enable.disable');
    });

    // Fornecedor
    Route::prefix('provider')->group(function () {
        Route::get('/list', [ProviderController::class, 'index'])->name('provider.list.all');
        Route::get('/list/find', [ProviderController::class, 'show'])->name('provider.list.find');
        Route::put('/edit/{id}', [ProviderController::class, 'update'])->name('provider.edit');
        Route::post('/save', [ProviderController::class, 'store'])->name('provider.save');
        Route::put('/enable/disable', [ProviderController::class, 'enableDisable'])->name('provider.enable.disable');
    });

    //  Telefone
    Route::prefix('telephone')->group(function () {
        Route::get('/list', [TelephoneController::class, 'index'])->name('telephone.list');
        Route::get('/list/ddd', [TelephoneController::class, 'ddd'])->name('telephone.ddd.list');
        Route::put('/edit/{id}', [TelephoneController::class, 'update'])->name('telephone.edit');
        Route::post('/save', [TelephoneController::class, 'store'])->name('telephone.save');
        Route::put('/enable/disable', [TelephoneController::class, 'enableDisable'])->name('telephone.enable.disable');
    });

    //  Usuario
    Route::prefix('user')->group(function () {
        Route::get('/list', [UserController::class, 'index'])->name('user.list.all');
        Route::get('/list/find', [UserController::class, 'show'])->name('user.list.find');
        Route::put('/edit/{id}', [UserController::class, 'update'])->name('user.edit');
        Route::put('/enable/disable', [UserController::class, 'enableDisable'])->name('user.enable.disable');
    });
});
