<?php

namespace App\Providers;

use App\Repositories\Concretes\AddressRepository;
use App\Repositories\Concretes\ProviderRepository;
use App\Repositories\Concretes\TelephoneRepository;
use App\Repositories\Concretes\UserRepository;
use App\Repositories\Interfaces\AddressRepositoryInterface;
use App\Repositories\Interfaces\ProviderRepositoryInterface;
use App\Repositories\Interfaces\TelephoneRepositoryInterface;
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
        );

        $this->app->bind
        (
            ProviderRepositoryInterface::class,
            ProviderRepository::class,
        );

        $this->app->bind
        (
            AddressRepositoryInterface::class,
            AddressRepository::class,
        );

        $this->app->bind
        (
            TelephoneRepositoryInterface::class,
            TelephoneRepository::class,
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
