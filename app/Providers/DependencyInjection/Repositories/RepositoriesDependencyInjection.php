<?php

namespace App\Providers\DependencyInjection\Repositories;

use App\Repositories\Abstracts\ICategoryRepository;
use App\Repositories\Abstracts\IEntityRepository;
use App\Repositories\Abstracts\IOrderRepository;
use App\Repositories\Abstracts\IPermissionRepository;
use App\Repositories\Abstracts\IProductRepository;
use App\Repositories\Abstracts\IProviderRepository;
use App\Repositories\Abstracts\IUserRepository;

use App\Repositories\Concretes\CategoryRepository;
use App\Repositories\Concretes\EntityRepository;
use App\Repositories\Concretes\OrderRepository;
use App\Repositories\Concretes\PermissionRepository;
use App\Repositories\Concretes\ProductRepository;
use App\Repositories\Concretes\ProviderRepository;
use App\Repositories\Concretes\UserRepository;
use Carbon\Laravel\ServiceProvider;

class RepositoriesDependencyInjection extends ServiceProvider
{
    /**
     * Register any application Repositories.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ICategoryRepository::class, CategoryRepository::class);

        $this->app->bind(IEntityRepository::class, EntityRepository::class);

        $this->app->bind(IOrderRepository::class, OrderRepository::class);

        $this->app->bind(IPermissionRepository::class, PermissionRepository::class);

        $this->app->bind(IProductRepository::class, ProductRepository::class);

        $this->app->bind(IProviderRepository::class, ProviderRepository::class);

        $this->app->bind(IUserRepository::class, UserRepository::class);
    }
}
