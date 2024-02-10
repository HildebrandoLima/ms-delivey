<?php

namespace App\Providers\DependencyInjection\Repositories;

use Carbon\Laravel\ServiceProvider;

class RepositoriesDependencyInjection extends ServiceProvider
{
    public function register(): void
    {
        $this->mapBindRepositories(CategoryDi::$interfaces, CategoryDi::$concretes);
        $this->mapBindRepositories(EntityDi::$interfaces, EntityDi::$concretes);
    }

    protected function mapBindRepositories(array $interfaces, array $concretes): void
    {
        foreach ($interfaces as $index => $interface) {
            $this->bindRepository($interface, $concretes[$index]);
        }
    }

    protected function bindRepository(string $interface, string $implementation): void
    {
        $this->app->bind($interface, $implementation);
    }
}
