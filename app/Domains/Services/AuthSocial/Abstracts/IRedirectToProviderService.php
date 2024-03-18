<?php

namespace App\Domains\Services\AuthSocial\Abstracts;

use Illuminate\Http\RedirectResponse;

interface IRedirectToProviderService
{
    public function redirectToProvider(string $provider): RedirectResponse;
}
