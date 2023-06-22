<?php

namespace App\Services\AuthSocial\Concretes;

use App\Exceptions\HttpBadRequest;
use App\Services\AuthSocial\Interfaces\RedirectToProviderServiceInterface;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\RedirectResponse;

class RedirectToProviderService implements RedirectToProviderServiceInterface
{
    public function redirectToProvider(string $provider): RedirectResponse
    {
        $this->validateProvider($provider);
        return Socialite::driver($provider)->stateless()->redirect();
    }

    private function validateProvider(string $provider): void
    {
        if (!in_array($provider, ['facebook', 'google', 'github'])):
            throw new HttpBadRequest('Por favor, faça login usando o Facebook, GitHub ou Google!');
        endif;
    }
}