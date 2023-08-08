<?php

namespace App\Providers\DependencyInjection\Repositories;

use App\Repositories\Abstracts\IEntityRepository;
use App\Repositories\Abstracts\IProviderRepository;
use App\Repositories\Abstracts\IUserRepository;

use App\Repositories\Concretes\EntityRepository;
use App\Repositories\Concretes\ProviderRepository;
use App\Repositories\Concretes\UserRepository;


use App\Repositories\Concretes\AddressRepository;
use App\Repositories\Concretes\AuthRepositoy;
use App\Repositories\Concretes\CategoryRepository;
use App\Repositories\Concretes\ImageRepository;
use App\Repositories\Concretes\ItemRepository;
use App\Repositories\Concretes\OrderRepository;
use App\Repositories\Concretes\PaymentRepository;
use App\Repositories\Concretes\PermissionRepository;
use App\Repositories\Concretes\ProductRepository;
use App\Repositories\Concretes\TelephoneRepository;
use App\Repositories\Interfaces\AddressRepositoryInterface;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\ImageRepositoryInterface;
use App\Repositories\Interfaces\ItemRepositoryInterface;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Repositories\Interfaces\PaymentRepositoryInterface;
use App\Repositories\Interfaces\PermissionRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\Interfaces\ProviderRepositoryInterface;
use App\Repositories\Interfaces\TelephoneRepositoryInterface;
use Carbon\Laravel\ServiceProvider;

class RepositoriesDependencyInjection extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AddressRepositoryInterface::class, AddressRepository::class);

        $this->app->bind(AuthRepositoryInterface::class, AuthRepositoy::class);

        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);

        $this->app->bind(ImageRepositoryInterface::class, ImageRepository::class);

        $this->app->bind(ItemRepositoryInterface::class, ItemRepository::class);

        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);

        $this->app->bind(PaymentRepositoryInterface::class, PaymentRepository::class);

        $this->app->bind(PermissionRepositoryInterface::class, PermissionRepository::class);

        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);

        $this->app->bind(TelephoneRepositoryInterface::class, TelephoneRepository::class);

        $this->app->bind(IEntityRepository::class, EntityRepository::class);

        $this->app->bind(IProviderRepository::class, ProviderRepository::class);

        $this->app->bind(IUserRepository::class, UserRepository::class);
    }
}
