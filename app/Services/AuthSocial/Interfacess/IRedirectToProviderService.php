<?php

namespace App\Services\AuthSocial\Interfacess;

use Illuminate\Http\RedirectResponse;

interface IRedirectToProviderService
{
    public function redirectToProvider(string $provider): RedirectResponse;
}
