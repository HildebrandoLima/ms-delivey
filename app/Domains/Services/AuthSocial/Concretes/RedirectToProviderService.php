<?php

namespace App\Domains\Services\AuthSocial\Concretes;

use App\Domains\Services\AuthSocial\Interfaces\IRedirectToProviderService;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\RedirectResponse;

class RedirectToProviderService implements IRedirectToProviderService
{
    public function redirectToProvider(string $provider): RedirectResponse
    {
        return Socialite::driver($provider)->stateless()->redirect();
    }
}
