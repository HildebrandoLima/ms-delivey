<?php

namespace App\Domains\Services\User\Concretes;

use App\Data\Repositories\Abstracts\IEntityRepository;
use App\Data\Repositories\Abstracts\IPermissionRepository;
use App\Domains\Services\User\Abstracts\ICreateUserService;
use App\Http\Requests\User\CreateUserRequest;
use App\Jobs\EmailForRegisterJob;
use App\Models\PermissionUser;
use App\Models\User;
use App\Support\Enums\AtivoEnum;
use Illuminate\Support\Facades\Hash;

class CreateUserService implements ICreateUserService
{
    private IEntityRepository $userRepository;
    private IPermissionRepository $permissionRepository;
    private array $permissionsAdmin = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19];
    private array $permissionsClient = [3, 4, 7, 10, 11, 14, 18, 19];

    public function __construct
    (
        IEntityRepository       $userRepository,
        IPermissionRepository $permissionRepository,
    )
    {
        $this->userRepository       = $userRepository;
        $this->permissionRepository = $permissionRepository;
    }

    public function createUser(CreateUserRequest $request): int
    {
        $user = $this->mapUser($request);
        $userId = $this->userRepository->create($user);
        $permission = $this->createPermission($request->eAdmin, $userId);
        if ($userId && $permission) $this->dispatchJob($request->email, $userId);
        return $userId;
    }

    public function mapUser(CreateUserRequest $request): User
    {
        $user = new User();
        $user->nome = $request->nome;
        $user->cpf = $request->cpf;
        $user->email = $request->email;
        $user->password = Hash::make($request->senha);
        $user->data_nascimento = $request->dataNascimento;
        $user->genero = $request->genero;
        $user->e_admin = $request->eAdmin;
        $user->ativo = AtivoEnum::ATIVADO;
        return $user;
    }

    public function createPermission(bool $isAdmin, int $userId): bool
    {
        if ($isAdmin == true):
            foreach ($this->permissionsAdmin as $permission):
                $permission = $this->mapPermission($userId, $permission);
                $this->permissionRepository->create($permission);
            endforeach;
        else:
            foreach ($this->permissionsClient as $permission):
                $permission = $this->mapPermission($userId, $permission);
                $this->permissionRepository->create($permission);
            endforeach;
        endif;
        return true;
    }

    public function mapPermission(int $userId, int $permission): PermissionUser
    {
        $permissionUser = new PermissionUser();
        $permissionUser->user_id = $userId;
        $permissionUser->permission_id = $permission;
        return $permissionUser;
    }

    private function dispatchJob(string $email, int $userId): void
    {
        EmailForRegisterJob::dispatch($email, $userId);
    }
}
