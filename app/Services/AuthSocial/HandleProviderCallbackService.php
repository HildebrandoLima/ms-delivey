<?php

namespace App\Services\AuthSocial;

use App\Exceptions\HttpBadRequest;
use App\Models\User;
use App\Services\AuthSocial\Interfacess\IAuthSocialService;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Collection;
use Laravel\Socialite\Facades\Socialite;

class AuthSocialService implements IAuthSocialService
{
    private string $provider;
    private Socialite $userSocial;
    private array $user;

    public function authSocial(string $provider): Collection
    {
        $this->provider = $provider;
        $this->redirectToProvider();
        $this->handleProviderCallback();
        $user = $this->createUserSocial();
        return collect([
            'accessToken' => $user['token'],
            'userId' => $user['id'],
            'userName' => $user['name'],
            'userEmail' => $user['email'],
        ]);
    }

    private function redirectToProvider(): Socialite
    {
        $this->validateProvider();
        return Socialite::driver($this->provider)->stateless()->redirect();
    }

    private function handleProviderCallback(): Socialite
    {
        $this->validateProvider();
        try {
            $this->userSocial = Socialite::driver($this->provider)->stateless()->user();
        } catch (ClientException $exception) {
            throw new HttpBadRequest('Credenciais Inválidas!');
        }
        return $this->userSocial;
    }

    private function createUserSocial(): array
    {
        $this->user = User::query()->create([
            'provider' => $this->provider,
            'provider_id' => $this->userSocial->getId(),
            'name' => $this->userSocial->getName(),
            'email' => $this->userSocial->getEmail(),
            'data_nascimento' => now(),
            'genero' => 'Outro',
            'ativo' => true,
            'email_verified_at' => $this->userSocial->,
        ]);
        return $this->user->toArray();
    }

    private function validateProvider(): void
    {
        if (!in_array($this->provider, ['facebook', 'google', 'github'])):
            throw new HttpBadRequest('Por favor, faça login usando o Facebook, GitHub ou Google!');
        endif;
    }
}
