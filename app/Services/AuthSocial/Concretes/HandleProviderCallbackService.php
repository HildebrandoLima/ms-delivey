<?php

namespace App\Services\AuthSocial\Concretes;

use App\Models\User;
use App\Repositories\Abstracts\IEntityRepository;
use App\Repositories\Abstracts\IPermissionRepository;
use App\Repositories\Abstracts\IUserRepository;
use App\Services\AuthSocial\Interfaces\HandleProviderCallbackServiceInterface;
use App\Support\Enums\AtivoEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Laravel\Socialite\Facades\Socialite;
use Tymon\JWTAuth\Facades\JWTAuth;

class HandleProviderCallbackService implements HandleProviderCallbackServiceInterface
{
    private IEntityRepository     $entityRepository;
    private IUserRepository       $userRepository;
    private IPermissionRepository $permissionRepository;
    private User $user;
    private $userSocial;
    private string $provider = '';
    private array $permissions = [3, 4, 7, 10, 11, 14, 18, 19];

    public function __construct
    (
        IEntityRepository     $entityRepository,
        IUserRepository       $userRepository,
        IPermissionRepository $permissionRepository,
    )
    {
        $this->entityRepository     = $entityRepository;
        $this->userRepository       = $userRepository;
        $this->permissionRepository = $permissionRepository;
    }

    public function handleProviderCallback(string $provider): Collection
    {
        $this->provider = $provider;
        $this->userSocial = Socialite::driver($this->provider)->stateless()->user();
        $this->createUserSocial();
        return collect(['accessToken' => JWTAuth::fromUser($this->user)]);
    }

    private function createUserSocial(): User
    {
        $userModel = $this->map();
        $checkUser = $this->checkExist();
        if (is_null($checkUser)):
            $userId = $this->entityRepository->create($userModel);
            $this->createPermission($userId);
        endif;
        $this->user = $this->user();
        return $this->user;
    }

    private function map(): User
    {
        $user = new User();
        $user->login_social_id = $this->userSocial->getId();
        $user->login_social = $this->provider;
        $user->nome = $this->userSocial->getName();
        $user->email = $this->userSocial->getEmail();
        $user->email_verified_at = true;
        $user->e_admin = false;
        $user->ativo = AtivoEnum::ATIVADO;
        return $user;
    }

    private function checkExist(): int|null
    {
        $check = $this->userRepository->readSocial($this->userSocial->getEmail());
        if (is_null($check)):
            return null;
        else:
            return 1;
        endif;
    }

    private function createPermission(int $userId): bool
    {
        foreach ($this->permissions as $permission):
            $this->permissionRepository->create($userId, $permission);
        endforeach;
        return true;
    }

    private function user(): Model
    {
        return $this->userRepository->readSocial($this->userSocial->getEmail());
    }
}
