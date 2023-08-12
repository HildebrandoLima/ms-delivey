<?php

namespace App\Providers\DependencyInjection\Services;

use App\Services\Address\Abstracts\ICreateAddressService;
use App\Services\Address\Abstracts\IEditAddressService;
use App\Services\Auth\Abstracts\IForgotPasswordService;
use App\Services\Auth\Abstracts\ILoginService;
use App\Services\Auth\Abstracts\ILogoutService;
use App\Services\Auth\Abstracts\IRefreshPasswordService;
use App\Services\AuthSocial\Abstracts\IHandleProviderCallbackService;
use App\Services\AuthSocial\Abstracts\IRedirectToProviderService;
use App\Services\Category\Abstracts\ICreateCategoryService;
use App\Services\Category\Abstracts\IEditCategoryService;
use App\Services\Category\Abstracts\IListCategoryService;
use App\Services\Order\Abstracts\ICreateOrderService;
use App\Services\Order\Abstracts\IListOrderService;
use App\Services\Payment\Abstracts\ICreatePaymentService;
use App\Services\Product\Abstracts\ICreateProductService;
use App\Services\Product\Abstracts\IEditProductService;
use App\Services\Product\Abstracts\IListProductService;
use App\Services\Provider\Abstracts\ICreateProviderService;
use App\Services\Provider\Abstracts\IEditProviderService;
use App\Services\Provider\Abstracts\IListProviderService;
use App\Services\Telephone\Abstracts\ICreateTelephoneService;
use App\Services\Telephone\Abstracts\IEditTelephoneService;
use App\Services\User\Abstracts\ICreateUserService;
use App\Services\User\Abstracts\IEditUserService;
use App\Services\User\Abstracts\IEmailUserVerifiedAtService;
use App\Services\User\Abstracts\IListUserService;

use App\Services\Address\Concretes\CreateAddressService;
use App\Services\Address\Concretes\EditAddressService;
use App\Services\Auth\Concretes\ForgotPasswordService;
use App\Services\Auth\Concretes\LoginService;
use App\Services\Auth\Concretes\LogoutService;
use App\Services\Auth\Concretes\RefreshPasswordService;
use App\Services\AuthSocial\Concretes\HandleProviderCallbackService;
use App\Services\AuthSocial\Concretes\RedirectToProviderService;
use App\Services\Category\Concretes\CreateCategoryService;
use App\Services\Category\Concretes\EditCategoryService;
use App\Services\Category\Concretes\ListCategoryService;
use App\Services\Order\Concretes\CreateOrderService;
use App\Services\Order\Concretes\ListOrderService;
use App\Services\Payment\Concretes\CreatePaymentService;
use App\Services\Product\Concretes\CreateProductService;
use App\Services\Product\Concretes\EditProductService;
use App\Services\Product\Concretes\ListProductService;
use App\Services\Provider\Concretes\CreateProviderService;
use App\Services\Provider\Concretes\EditProviderService;
use App\Services\Provider\Concretes\ListProviderService;
use App\Services\Telephone\Concretes\CreateTelephoneService;
use App\Services\Telephone\Concretes\EditTelephoneService;
use App\Services\User\Concretes\CreateUserService;
use App\Services\User\Concretes\EditUserService;
use App\Services\User\Concretes\EmailUserVerifiedAtService;
use App\Services\User\Concretes\ListUserService;
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
        $this->app->bind(ICreateAddressService::class, CreateAddressService::class);

        $this->app->bind(IEditAddressService::class, EditAddressService::class);

        $this->app->bind(IForgotPasswordService::class, ForgotPasswordService::class);

        $this->app->bind(ILoginService::class, LoginService::class);

        $this->app->bind(ILogoutService::class, LogoutService::class);

        $this->app->bind(IRefreshPasswordService::class, RefreshPasswordService::class);

        $this->app->bind(IHandleProviderCallbackService::class, HandleProviderCallbackService::class);

        $this->app->bind(IRedirectToProviderService::class, RedirectToProviderService::class);

        $this->app->bind(ICreateCategoryService::class, CreateCategoryService::class);

        $this->app->bind(IEditCategoryService::class, EditCategoryService::class);

        $this->app->bind(IListCategoryService::class, ListCategoryService::class);

        $this->app->bind(ICreateOrderService::class, CreateOrderService::class);

        $this->app->bind(IListOrderService::class, ListOrderService::class);

        $this->app->bind(ICreatePaymentService::class, CreatePaymentService::class);

        $this->app->bind(ICreateProductService::class, CreateProductService::class);

        $this->app->bind(IEditProductService::class, EditProductService::class);

        $this->app->bind(IListProductService::class, ListProductService::class);

        $this->app->bind(ICreateProviderService::class, CreateProviderService::class);

        $this->app->bind(IEditProviderService::class, EditProviderService::class);

        $this->app->bind(IListProviderService::class, ListProviderService::class);

        $this->app->bind(ICreateTelephoneService::class, CreateTelephoneService::class);

        $this->app->bind(IEditTelephoneService::class, EditTelephoneService::class);

        $this->app->bind(ICreateUserService::class, CreateUserService::class);

        $this->app->bind(IEditUserService::class, EditUserService::class);

        $this->app->bind(IEmailUserVerifiedAtService::class, EmailUserVerifiedAtService::class);

        $this->app->bind(IListUserService::class, ListUserService::class);
    }
}
