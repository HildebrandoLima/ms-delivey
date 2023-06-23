<?php

namespace App\Services\AuthSocial\Concretes;

use App\DataTransferObjects\RequestsDtos\UserRequestDto;
use App\Exceptions\HttpBadRequest;
use App\Models\User;
use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\AuthSocial\Interfaces\HandleProviderCallbackServiceInterface;
use App\Support\Utils\Enums\PerfilEnum;
use App\Support\Utils\Enums\UserEnum;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Collection;
use Laravel\Socialite\Facades\Socialite;
use Tymon\JWTAuth\Facades\JWTAuth;

class HandleProviderCallbackService implements HandleProviderCallbackServiceInterface
{
    private $userSocial;
    private string $provider;
    private User   $user;
    private CheckEntityRepositoryInterface $checkEntityRepository;
    private UserRepositoryInterface        $userRepository;

    public function __construct
    (
        CheckEntityRepositoryInterface $checkEntityRepository,
        UserRepositoryInterface        $userRepository,
    )
    {
        $this->checkEntityRepository = $checkEntityRepository;
        $this->userRepository        = $userRepository;
    }

    public function handleProviderCallback(string $provider): Collection
    {
        try {
            $this->provider = $provider;
            $this->validateProvider();
            $this->userSocial = Socialite::driver($this->provider)->stateless()->user();
            $this->createUserSocial();
            return collect([
                'accessToken' => JWTAuth::fromUser($this->user),
                'userId' => $this->user->id,
                'userName' => $this->user->name,
                'userEmail' => $this->user->email,
                'perfilName' => "Cliente"
            ]);
        } catch (ClientException $e) {
            throw new HttpBadRequest('Credenciais Inválidas!');
        }
    }

    private function validateProvider(): void
    {
        if (!in_array($this->provider, ['facebook', 'google', 'github'])):
            throw new HttpBadRequest('Por favor, faça login usando o Facebook, GitHub ou Google!');
        endif;
    }

    private function createUserSocial(): User
    {
        $userDto = UserRequestDto::fromRquest($this->mapToUserSocial());
        $userId = $this->checkExist();
        if (is_null($userId)):
            $this->user = $this->userRepository->create($userDto);
        else:
            $this->user = $this->userRepository->update($userId, $userDto);
        endif;
        return $this->user;
    }

    private function mapToUserSocial(): array
    {
        $user = array
        (
            'loginSocialId' => $this->userSocial->getId(),
            'loginSocial' => $this->provider,
            'perfilId' => PerfilEnum::CLIENTE,
            'nome' => $this->userSocial->getName(),
            'cpf' => null,
            'email' => $this->userSocial->getEmail(),
            'senha' => null,
            'dataNascimento' => null,
            'genero' => 'Outro',
            'ativo' => UserEnum::ATIVADO,
        );
        return $user;
    }

    private function checkExist(): int|null
    {
        return $this->checkEntityRepository->checkUserSocial($this->userSocial->getEmail());
    }
}
