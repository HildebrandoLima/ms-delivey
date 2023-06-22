<?php

namespace App\Services\AuthSocial\Interfaces;

use Illuminate\Support\Collection;

interface HandleProviderCallbackServiceInterface
{
    public function handleProviderCallback(string $provider): Collection;
}
