<?php

namespace App\Domains\Services\AuthSocial\Abstracts;

use Illuminate\Support\Collection;

interface IHandleProviderCallbackService
{
    public function handleProviderCallback(string $provider): Collection;
}
