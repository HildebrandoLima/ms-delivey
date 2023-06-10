<?php

namespace App\Services\AuthSocial;

use App\Exceptions\HttpBadRequest;
use App\Models\User;
use App\Repositories\CheckRegisterRepository;
use App\Repositories\UserRepository;
use App\Services\AuthSocial\Interfacess\IHandleProviderCallbackService;
use App\Support\Utils\Enums\PerfilEnum;
use App\Support\Utils\Enums\UserEnum;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Collection;
use Laravel\Socialite\Facades\Socialite;
use Tymon\JWTAuth\Facades\JWTAuth;

class HandleProviderCallbackService implements IHandleProviderCallbackService
{
    private $userSocial;
    private string $provider;
    private User $user;
    private CheckRegisterRepository $checkRegisterRepository;
    private UserRepository $userRepository;

    public function __construct
    (
        CheckRegisterRepository $checkRegisterRepository,
        UserRepository          $userRepository
    )
    {
        $this->checkRegisterRepository = $checkRegisterRepository;
        $this->userRepository          = $userRepository;
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
        $userModel = $this->mapToModel();
        $userId = $this->checkExist();
        if (is_null($userId)):
            $this->user = $this->userRepository->create($userModel);
        else:
            $this->user = $this->userRepository->update($userId, $userModel);
        endif;
        return $this->user;
    }

    private function mapToModel(): User
    {
        $user = new User();
        $user->provider_id = $this->userSocial->getId();
        $user->provider = $this->provider;
        $user->name = $this->userSocial->getName();
        $user->cpf = null;
        $user->email = $this->userSocial->getEmail();
        $user->data_nascimento = null;
        $user->genero = 'Outro';
        $user->ativo = UserEnum::ATIVADO;
        $user->perfil_id - PerfilEnum::CLIENTE;
        return $user;
    }

    private function checkExist()
    {
        return $this->checkRegisterRepository->checkUserSocial($this->userSocial->getEmail());
    }
}
