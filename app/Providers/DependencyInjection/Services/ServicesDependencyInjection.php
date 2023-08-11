<?php

namespace App\Providers\DependencyInjection\Services;

use App\Services\Address\Concretes\CreateAddressService;
use App\Services\Address\Concretes\EditAddressService;
use App\Services\Address\Interfaces\CreateAddressServiceInterface;
use App\Services\Address\Interfaces\EditAddressServiceInterface;
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
use App\Services\Category\Concretes\EditCategoryService;
use App\Services\Category\Concretes\ListCategoryService;
use App\Services\Category\Interfaces\CreateCategoryServiceInterface;
use App\Services\Category\Interfaces\EditCategoryServiceInterface;
use App\Services\Category\Interfaces\ListCategoryServiceInterface;
use App\Services\Order\Concretes\CreateOrderService;
use App\Services\Order\Concretes\ListOrderService;
use App\Services\Order\Interfaces\CreateOrderServiceInterface;
use App\Services\Order\Interfaces\ListOrderServiceInterface;
use App\Services\Payment\Concretes\CreatePaymentService;
use App\Services\Payment\Interfaces\CreatePaymentServiceInterface;
use App\Services\Product\Concretes\CreateProductService;
use App\Services\Product\Concretes\EditProductService;
use App\Services\Product\Concretes\ListProductService;
use App\Services\Product\Interfaces\CreateProductServiceInterface;
use App\Services\Product\Interfaces\EditProductServiceInterface;
use App\Services\Product\Interfaces\ListProductServiceInterface;
use App\Services\Provider\Concretes\CreateProviderService;
use App\Services\Provider\Concretes\EditProviderService;
use App\Services\Provider\Concretes\ListProviderService;
use App\Services\Provider\Interfaces\CreateProviderServiceInterface;
use App\Services\Provider\Interfaces\EditProviderServiceInterface;
use App\Services\Provider\Interfaces\ListProviderServiceInterface;
use App\Services\Telephone\Concretes\CreateTelephoneService;
use App\Services\Telephone\Concretes\EditTelephoneService;
use App\Services\Telephone\Concretes\ListTelephoneService;
use App\Services\Telephone\Interfaces\CreateTelephoneServiceInterface;
use App\Services\Telephone\Interfaces\EditTelephoneServiceInterface;
use App\Services\Telephone\Interfaces\ListTelephoneServiceInterface;
use App\Services\User\Concretes\CreateUserService;
use App\Services\User\Concretes\EditUserService;
use App\Services\User\Concretes\EmailUserVerifiedAtService;
use App\Services\User\Concretes\ListUserService;
use App\Services\User\Interfaces\CreateUserServiceInterface;
use App\Services\User\Interfaces\EditUserServiceInterface;
use App\Services\User\Interfaces\EmailUserVerifiedAtServiceInterface;
use App\Services\User\Interfaces\ListUserServiceInterface;
use Carbon\Laravel\ServiceProvider;

class ServicesDependencyInjection extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CreateAddressServiceInterface::class, CreateAddressService::class);

        $this->app->bind(EditAddressServiceInterface::class, EditAddressService::class);

        $this->app->bind(ForgotPasswordServiceInterface::class, ForgotPasswordService::class);

        $this->app->bind(LoginServiceInterface::class, LoginService::class);

        $this->app->bind(LogoutServiceInterface::class, LogoutService::class);

        $this->app->bind(RefreshPasswordServiceInterface::class, RefreshPasswordService::class);

        $this->app->bind(HandleProviderCallbackServiceInterface::class, HandleProviderCallbackService::class);

        $this->app->bind(RedirectToProviderServiceInterface::class, RedirectToProviderService::class);

        $this->app->bind(CreateCategoryServiceInterface::class, CreateCategoryService::class);

        $this->app->bind(EditCategoryServiceInterface::class, EditCategoryService::class);

        $this->app->bind(ListCategoryServiceInterface::class, ListCategoryService::class);

        $this->app->bind(CreateOrderServiceInterface::class, CreateOrderService::class);

        $this->app->bind(ListOrderServiceInterface::class, ListOrderService::class);

        $this->app->bind(CreatePaymentServiceInterface::class, CreatePaymentService::class);

        $this->app->bind(CreateProductServiceInterface::class, CreateProductService::class);

        $this->app->bind(EditProductServiceInterface::class, EditProductService::class);

        $this->app->bind(ListProductServiceInterface::class, ListProductService::class);

        $this->app->bind(CreateProviderServiceInterface::class, CreateProviderService::class);

        $this->app->bind(EditProviderServiceInterface::class, EditProviderService::class);

        $this->app->bind(ListProviderServiceInterface::class, ListProviderService::class);

        $this->app->bind(CreateTelephoneServiceInterface::class, CreateTelephoneService::class);

        $this->app->bind(EditTelephoneServiceInterface::class, EditTelephoneService::class);

        $this->app->bind(ListTelephoneServiceInterface::class, ListTelephoneService::class);

        $this->app->bind(CreateUserServiceInterface::class, CreateUserService::class);

        $this->app->bind(EditUserServiceInterface::class, EditUserService::class);

        $this->app->bind(EmailUserVerifiedAtServiceInterface::class, EmailUserVerifiedAtService::class);

        $this->app->bind(ListUserServiceInterface::class, ListUserService::class);
    }
}
