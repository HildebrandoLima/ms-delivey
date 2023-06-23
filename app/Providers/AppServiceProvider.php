<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Model::handleLazyLoadingViolationUsing(function ($model, $relation) {
            $class = get_class($model);

            Log::info("Tentativa de carregamento lento [{$relation}] no modelo [{$class}].");
        });
    }
}
