<?php

namespace App\Providers\DependencyInjection\Services;

use Carbon\Laravel\ServiceProvider;

class ServicesDependencyInjection extends ServiceProvider
{
    public function register(): void
    {
        $this->mapBindServices(AddressDi::$interfaces, AddressDi::$concretes);
        $this->mapBindServices(AuthDi::$interfaces, AuthDi::$concretes);
        $this->mapBindServices(AuthSocialDi::$interfaces, AuthSocialDi::$concretes);
        $this->mapBindServices(CategoryDi::$interfaces, CategoryDi::$concretes);
        $this->mapBindServices(OrderDi::$interfaces, OrderDi::$concretes);
    }

    protected function mapBindServices(array $interfaces, array $concretes): void
    {
        foreach ($interfaces as $index => $interface) {
            $this->bindService($interface, $concretes[$index]);
        }
    }

    protected function bindService(string $interface, string $implementation): void
    {
        $this->app->bind($interface, $implementation);
    }
}
