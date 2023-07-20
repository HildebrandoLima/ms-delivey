<?php

namespace App\Services\AuthSocial\Concretes;

use App\DataTransferObjects\RequestsDtos\UserRequestDto;
use App\Exceptions\HttpBadRequest;
use App\Models\User;
use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\AuthSocial\Interfaces\HandleProviderCallbackServiceInterface;
use App\Support\Permissions\CreatePermissions;
use App\Support\Enums\PerfilEnum;
use App\Support\Enums\UserEnum;
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
    private CreatePermissions      $createPermissions;

    public function __construct
    (
        CheckEntityRepositoryInterface $checkEntityRepository,
        UserRepositoryInterface        $userRepository,
        CreatePermissions              $createPermissions,
    )
    {
        $this->checkEntityRepository = $checkEntityRepository;
        $this->userRepository        = $userRepository;
        $this->createPermissions     = $createPermissions;
    }

    public function handleProviderCallback(string $provider): Collection
    {
        try {
            $this->provider = $provider;
            $this->validateProvider();
            $this->userSocial = Socialite::driver($this->provider)->stateless()->user();
            $this->createUserSocial();
            $this->createPermissions->createPermissions(PerfilEnum::CLIENTE, $this->user->id);
            return collect([
                'accessToken' => JWTAuth::fromUser($this->user),
                'userId' => auth()->user()->id,
                'userName' => auth()->user()->name,
                'userEmail' => auth()->user()->email,
                'isAdmin' => UserEnum::NAO_E_ADMIN,
                'permissions' => auth()->user()->permissions
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
            'perfil' => PerfilEnum::CLIENTE,
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
