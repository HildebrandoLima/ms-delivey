<?php

namespace App\Services\AuthSocial\Interfaces;

use Illuminate\Http\RedirectResponse;

interface RedirectToProviderServiceInterface
{
    public function redirectToProvider(string $provider): RedirectResponse;
}
