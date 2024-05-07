<?php

namespace App\Domains\Services\AuthSocial\Concretes;

use App\Data\Repositories\Abstracts\IPermissionRepository;
use App\Domains\Services\AuthSocial\Abstracts\IHandleProviderCallbackService;
use App\Models\PermissionUser;
use App\Models\User;
use App\Support\Enums\ActiveEnum;
use Illuminate\Support\Collection;
use Laravel\Socialite\Facades\Socialite;

class HandleProviderCallbackService implements IHandleProviderCallbackService
{
    private IPermissionRepository $permissionRepository;
    private User $user;
    private $userSocial;
    private string $provider = '';
    private array $permissions = [3, 4, 7, 10, 11, 14, 18, 19];

    public function __construct(IPermissionRepository $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    public function handleProviderCallback(string $provider): Collection
    {
        $this->provider = $provider;
        $this->userSocial = Socialite::driver($this->provider)->stateless()->user();
        $user = $this->validateUser();
        $this->createPermission($user->id);
        return collect(['accessToken' => auth()->login($this->user)]);
    }

    private function validateUser(): User
    {
        $this->user = User::firstOrCreate(['email' => $this->userSocial->getEmail()], [$this->map()]);
        return $this->user;
    }

    private function map(): User
    {
        $user = new User();
        $user->login_social_id = $this->userSocial->getId();
        $user->login_social = $this->provider;
        $user->nome = $this->userSocial->getName();
        $user->cpf = null;
        $user->email = $this->userSocial->getEmail();
        $user->password = null;
        $user->data_nascimento = null;
        $user->genero = 'Outro';
        $user->email_verificado = true;
        $user->e_admin = false;
        $user->ativo = ActiveEnum::ATIVADO;
        return $user;
    }

    private function createPermission(int $userId): bool
    {
        foreach ($this->permissions as $permission):
            $permission = $this->mapPermission($userId, $permission);
            $this->permissionRepository->create($permission);
        endforeach;
        return true;
    }

    private function mapPermission(int $userId, int $permission): PermissionUser
    {
        $permissionUser = new PermissionUser();
        $permissionUser->user_id = $userId;
        $permissionUser->permission_id = $permission;
        return $permissionUser;
    }
}
