<?php

namespace App\Services\AuthSocial\Concretes;

use App\Services\AuthSocial\Interfaces\RedirectToProviderServiceInterface;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\RedirectResponse;

class RedirectToProviderService implements RedirectToProviderServiceInterface
{
    public function redirectToProvider(string $provider): RedirectResponse
    {
        return Socialite::driver($provider)->stateless()->redirect();
    }
}
