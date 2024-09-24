<?php

namespace App\Domain\Services\AuthSocial\Abstracts;

use Illuminate\Http\RedirectResponse;

interface IRedirectToProviderService
{
    public function redirectToProvider(string $provider): RedirectResponse;
}
