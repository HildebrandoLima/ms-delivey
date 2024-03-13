<?php

namespace App\Providers\DependencyInjection\Services;

use App\Services\AuthSocial\Abstracts\IHandleProviderCallbackService;
use App\Services\AuthSocial\Abstracts\IRedirectToProviderService;
use App\Services\AuthSocial\Concretes\HandleProviderCallbackService;
use App\Services\AuthSocial\Concretes\RedirectToProviderService;

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
