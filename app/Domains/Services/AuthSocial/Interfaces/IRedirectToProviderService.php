<?php

namespace App\Domains\Services\AuthSocial\Interfaces;

use Illuminate\Http\RedirectResponse;

interface IRedirectToProviderService
{
    public function redirectToProvider(string $provider): RedirectResponse;
}
