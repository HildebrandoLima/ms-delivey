<?php

namespace App\Providers\DependencyInjection\Repositories;

use Carbon\Laravel\ServiceProvider;

class DependencyInjection extends ServiceProvider
{
    public function register(): void
    {
        $this->mapBindRepositories(CategoryDi::$interfaces, CategoryDi::$concretes);
        $this->mapBindRepositories(EntityDi::$interfaces, EntityDi::$concretes);
        $this->mapBindRepositories(OrderDi::$interfaces, OrderDi::$concretes);
        $this->mapBindRepositories(PermissionDi::$interfaces, PermissionDi::$concretes);
        $this->mapBindRepositories(ProductDi::$interfaces, ProductDi::$concretes);
        $this->mapBindRepositories(ProviderDi::$interfaces, ProviderDi::$concretes);
        $this->mapBindRepositories(UserDi::$interfaces, UserDi::$concretes);
    }

    protected function mapBindRepositories(array $interfaces, array $concretes): void
    {
        foreach ($interfaces as $index => $interface):
            $this->bindRepository($interface, $concretes[$index]);
        endforeach;
    }

    protected function bindRepository(string $interface, string $implementation): void
    {
        $this->app->bind($interface, $implementation);
    }
}
