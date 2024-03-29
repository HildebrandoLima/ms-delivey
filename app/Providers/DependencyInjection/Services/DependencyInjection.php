<?php

namespace App\Providers\DependencyInjection\Services;

use Carbon\Laravel\ServiceProvider;

class DependencyInjection extends ServiceProvider
{
    public function register(): void
    {
        $this->mapBindServices(AddressDi::$interfaces, AddressDi::$concretes);
        $this->mapBindServices(AuthDi::$interfaces, AuthDi::$concretes);
        $this->mapBindServices(AuthSocialDi::$interfaces, AuthSocialDi::$concretes);
        $this->mapBindServices(CategoryDi::$interfaces, CategoryDi::$concretes);
        $this->mapBindServices(OrderDi::$interfaces, OrderDi::$concretes);
        $this->mapBindServices(PaymentDi::$interfaces, PaymentDi::$concretes);
        $this->mapBindServices(ProductDi::$interfaces, ProductDi::$concretes);
        $this->mapBindServices(ProviderDi::$interfaces, ProviderDi::$concretes);
        $this->mapBindServices(TelephoneDi::$interfaces, TelephoneDi::$concretes);
        $this->mapBindServices(UserDi::$interfaces, UserDi::$concretes);
    }

    protected function mapBindServices(array $interfaces, array $concretes): void
    {
        foreach ($interfaces as $index => $interface):
            $this->bindService($interface, $concretes[$index]);
        endforeach;
    }

    protected function bindService(string $interface, string $implementation): void
    {
        $this->app->bind($interface, $implementation);
    }
}
