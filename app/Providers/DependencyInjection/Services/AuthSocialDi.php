<?php

namespace App\Providers\DependencyInjection\Services;

use App\Services\AuthSocial\Abstracts\IHandleProviderCallbackService;
use App\Services\AuthSocial\Abstracts\IRedirectToProviderService;
use App\Services\AuthSocial\Concretes\HandleProviderCallbackService;

class AuthSocialDi
{
    public static $interfaces = [
        IHandleProviderCallbackService::class,
        IRedirectToProviderService::class,
    ];

    public static $concretes = [
        HandleProviderCallbackService::class,
        IRedirectToProviderService::class,
    ];
}
