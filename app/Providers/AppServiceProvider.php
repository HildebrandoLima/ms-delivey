<?php

namespace App\Providers;

use App\Repositories\Concretes\ProviderRepository;
use App\Repositories\Concretes\UserRepository;
use App\Repositories\Interfaces\ProviderRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
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
        $this->app->bind
        (
            UserRepositoryInterface::class,
            UserRepository::class,
            ProviderRepositoryInterface::class,
            ProviderRepository::class,
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
