<?php

namespace App\Providers\DependencyInjection\Services;

use App\Domains\Services\AuthSocial\Concretes\HandleProviderCallbackService;
use App\Domains\Services\AuthSocial\Concretes\RedirectToProviderService;

use App\Domains\Services\AuthSocial\Interfaces\IHandleProviderCallbackService;
use App\Domains\Services\AuthSocial\Interfaces\IRedirectToProviderService;

class AuthSocialDi
{
    public static $interfaces = [
        IHandleProviderCallbackService::class,
        IRedirectToProviderService::class,
    ];

    public static $concretes = [
        HandleProviderCallbackService::class,
        RedirectToProviderService::class,
    ];
}
