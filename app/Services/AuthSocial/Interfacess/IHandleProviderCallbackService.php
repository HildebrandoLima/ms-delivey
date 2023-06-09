<?php

namespace App\Services\AuthSocial\Interfacess;

use Illuminate\Support\Collection;

interface IHandleProviderCallbackService
{
    public function handleProviderCallback(string $provider): Collection;
}
