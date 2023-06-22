<?php

namespace App\Providers;

use App\Repositories\Concretes\AddressRepository;
use App\Repositories\Concretes\AuthRepositoy;
use App\Repositories\Concretes\CategoryRepository;
use App\Repositories\Concretes\CheckEntityRepository;
use App\Repositories\Concretes\ImageRepository;
use App\Repositories\Concretes\ItemRepository;
use App\Repositories\Concretes\OrderRepository;
use App\Repositories\Concretes\PaymentRepository;
use App\Repositories\Concretes\ProductRepository;
use App\Repositories\Concretes\ProviderRepository;
use App\Repositories\Concretes\TelephoneRepository;
use App\Repositories\Concretes\UserRepository;
use App\Repositories\Interfaces\AddressRepositoryInterface;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Repositories\Interfaces\ImageRepositoryInterface;
use App\Repositories\Interfaces\ItemRepositoryInterface;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Repositories\Interfaces\PaymentRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\Interfaces\ProviderRepositoryInterface;
use App\Repositories\Interfaces\TelephoneRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Address\Concretes\CreateAddressService;
use App\Services\Address\Concretes\DeleteAddressService;
use App\Services\Address\Concretes\EditAddressService;
use App\Services\Address\Concretes\ListAddressService;
use App\Services\Address\Interfaces\CreateAddressServiceInterface;
use App\Services\Address\Interfaces\DeleteAddressServiceInterface;
use App\Services\Address\Interfaces\EditAddressServiceInterface;
use App\Services\Address\Interfaces\ListAddressServiceInterface;
use App\Services\Auth\Concretes\ForgotPasswordService;
use App\Services\Auth\Concretes\LoginService;
use App\Services\Auth\Concretes\LogoutService;
use App\Services\Auth\Concretes\RefreshPasswordService;
use App\Services\Auth\Interfaces\ForgotPasswordServiceInterface;
use App\Services\Auth\Interfaces\LoginServiceInterface;
use App\Services\Auth\Interfaces\LogoutServiceInterface;
use App\Services\Auth\Interfaces\RefreshPasswordServiceInterface;
use App\Services\AuthSocial\Concretes\HandleProviderCallbackService;
use App\Services\AuthSocial\Concretes\RedirectToProviderService;
use App\Services\AuthSocial\Interfaces\HandleProviderCallbackServiceInterface;
use App\Services\AuthSocial\Interfaces\RedirectToProviderServiceInterface;
use App\Services\Category\Concretes\CreateCategoryService;
use App\Services\Category\Concretes\DeleteCategoryService;
use App\Services\Category\Concretes\EditCategoryService;
use App\Services\Category\Concretes\ListCategoryService;
use App\Services\Category\Interfaces\CreateCategoryServiceInterface;
use App\Services\Category\Interfaces\DeleteCategoryServiceInterface;
use App\Services\Category\Interfaces\EditCategoryServiceInterface;
use App\Services\Category\Interfaces\ListCategoryServiceInterface;
use App\Services\Order\Concretes\CreateOrderService;
use App\Services\Order\Concretes\DeleteOrderService;
use App\Services\Order\Concretes\ListOrderService;
use App\Services\Order\Interfaces\CreateOrderServiceInterface;
use App\Services\Order\Interfaces\DeleteOrderServiceInterface;
use App\Services\Order\Interfaces\ListOrderServiceInterface;
use App\Services\Payment\Concretes\CreatePaymentService;
use App\Services\Payment\Interfaces\CreatePaymentServiceInterface;
use App\Services\Product\Concretes\CreateProductService;
use App\Services\Product\Concretes\DeleteProductService;
use App\Services\Product\Concretes\EditProductSerice;
use App\Services\Product\Concretes\ListProductService;
use App\Services\Product\Interfaces\CreateProductServiceInterface;
use App\Services\Product\Interfaces\DeleteProductServiceInterface;
use App\Services\Product\Interfaces\EditProductSericeInterface;
use App\Services\Product\Interfaces\ListProductServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Services
        $this->app->bind
        (
            CreateAddressServiceInterface::class,
            CreateAddressService::class,
        );

        $this->app->bind
        (
            DeleteAddressServiceInterface::class,
            DeleteAddressService::class,
        );

        $this->app->bind
        (
            EditAddressServiceInterface::class,
            EditAddressService::class,
        );

        $this->app->bind
        (
            ListAddressServiceInterface::class,
            ListAddressService::class,
        );

        $this->app->bind
        (
            ForgotPasswordServiceInterface::class,
            ForgotPasswordService::class,
        );

        $this->app->bind
        (
            LoginServiceInterface::class,
            LoginService::class,
        );

        $this->app->bind
        (
            LogoutServiceInterface::class,
            LogoutService::class,
        );

        $this->app->bind
        (
            RefreshPasswordServiceInterface::class,
            RefreshPasswordService::class,
        );

        $this->app->bind
        (
            HandleProviderCallbackServiceInterface::class,
            HandleProviderCallbackService::class,
        );

        $this->app->bind
        (
            RedirectToProviderServiceInterface::class,
            RedirectToProviderService::class,
        );

        $this->app->bind
        (
            CreateCategoryServiceInterface::class,
            CreateCategoryService::class,
        );

        $this->app->bind
        (
            DeleteCategoryServiceInterface::class,
            DeleteCategoryService::class,
        );

        $this->app->bind
        (
            EditCategoryServiceInterface::class,
            EditCategoryService::class,
        );

        $this->app->bind
        (
            ListCategoryServiceInterface::class,
            ListCategoryService::class,
        );

        $this->app->bind
        (
            CreateOrderServiceInterface::class,
            CreateOrderService::class,
        );

        $this->app->bind
        (
            DeleteOrderServiceInterface::class,
            DeleteOrderService::class,
        );

        $this->app->bind
        (
            ListOrderServiceInterface::class,
            ListOrderService::class,
        );

        $this->app->bind
        (
            CreatePaymentServiceInterface::class,
            CreatePaymentService::class,
        );

        $this->app->bind
        (
            CreateProductServiceInterface::class,
            CreateProductService::class,
        );

        $this->app->bind
        (
            DeleteProductServiceInterface::class,
            DeleteProductService::class,
        );

        $this->app->bind
        (
            EditProductSericeInterface::class,
            EditProductSerice::class,
        );

        $this->app->bind
        (
            ListProductServiceInterface::class,
            ListProductService::class,
        );



        // Repositories
        $this->app->bind
        (
            AddressRepositoryInterface::class,
            AddressRepository::class,
        );

        $this->app->bind
        (
            AuthRepositoryInterface::class,
            AuthRepositoy::class,
        );

        $this->app->bind
        (
            CategoryRepositoryInterface::class,
            CategoryRepository::class,
        );

        $this->app->bind
        (
            CheckEntityRepositoryInterface::class,
            CheckEntityRepository::class,
        );

        $this->app->bind
        (
            ImageRepositoryInterface::class,
            ImageRepository::class,
        );

        $this->app->bind
        (
            ItemRepositoryInterface::class,
            ItemRepository::class,
        );

        $this->app->bind
        (
            OrderRepositoryInterface::class,
            OrderRepository::class,
        );

        $this->app->bind
        (
            PaymentRepositoryInterface::class,
            PaymentRepository::class,
        );

        $this->app->bind
        (
            ProductRepositoryInterface::class,
            ProductRepository::class,
        );

        $this->app->bind
        (
            ProviderRepositoryInterface::class,
            ProviderRepository::class,
        );

        $this->app->bind
        (
            TelephoneRepositoryInterface::class,
            TelephoneRepository::class,
        );

        $this->app->bind
        (
            UserRepositoryInterface::class,
            UserRepository::class,   
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
