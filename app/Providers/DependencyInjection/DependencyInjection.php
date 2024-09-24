<?php

namespace App\Providers\DependencyInjection;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Collection;

abstract class DependencyInjection
{
    private Application $app;
    abstract protected function services(): array;
    abstract protected function repositories(): array;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public static function providers(Application $app): Collection
    {
        return collect([
            new AddressDi($app),
            new AuthDi($app),
            new AuthSocialDi($app),
            new CategoryDi($app),
            new OrderDi($app),
            new PaymentDi($app),
            new ProductDi($app),
            new ProviderDi($app),
            new TelephoneDi($app),
            new UserDi($app)
        ]);
    }

    public function configure(): void
    {
        $configurations = array_merge($this->services(), $this->repositories());

        foreach ($configurations as $configuration) {
            $this->app->bind($configuration[0], $configuration[1]);
        }
    }
}
