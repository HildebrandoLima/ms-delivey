<?php

namespace App\Services\AuthSocial\Concretes;

use App\Services\AuthSocial\Abstracts\IRedirectToProviderService;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\RedirectResponse;

class RedirectToProviderService implements IRedirectToProviderService
{
    public function redirectToProvider(string $provider): RedirectResponse
    {
        return Socialite::driver($provider)->stateless()->redirect();
    }
}
