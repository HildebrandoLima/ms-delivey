<?php

namespace App\Domains\Services\AuthSocial\Interfaces;

use Illuminate\Support\Collection;

interface IHandleProviderCallbackService
{
    public function handleProviderCallback(string $provider): Collection;
}
