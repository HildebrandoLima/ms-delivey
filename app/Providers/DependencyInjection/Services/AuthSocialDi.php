<?php

namespace App\Providers\DependencyInjection\Services;

use App\Domains\Services\AuthSocial\Abstracts\IHandleProviderCallbackService;
use App\Domains\Services\AuthSocial\Abstracts\IRedirectToProviderService;
use App\Domains\Services\AuthSocial\Concretes\HandleProviderCallbackService;
use App\Domains\Services\AuthSocial\Concretes\RedirectToProviderService;

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
