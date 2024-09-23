<?php

namespace App\Providers\DependencyInjection;

use App\Domains\Services\AuthSocial\Concretes\HandleProviderCallbackService;
use App\Domains\Services\AuthSocial\Concretes\RedirectToProviderService;

use App\Domains\Services\AuthSocial\Interfaces\IHandleProviderCallbackService;
use App\Domains\Services\AuthSocial\Interfaces\IRedirectToProviderService;

class AuthSocialDi extends DependencyInjection
{
    protected function services(): array
    {
        return [
            [IHandleProviderCallbackService::class, HandleProviderCallbackService::class],
            [IRedirectToProviderService::class, RedirectToProviderService::class]
        ];
    }

    protected function repositories(): array
    {
        return [];
    }
}
