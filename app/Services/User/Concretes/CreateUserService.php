<?php

namespace App\Services\User\Concretes;

use App\Http\Requests\User\CreateUserRequest;
use App\Jobs\EmailForRegisterJob;
use App\Models\User;
use App\Repositories\Abstracts\EntityRepository;
use App\Repositories\Interfaces\PermissionRepositoryInterface;
use App\Services\User\Interfaces\CreateUserServiceInterface;
use App\Support\Enums\AtivoEnum;
use Illuminate\Support\Facades\Hash;

class CreateUserService implements CreateUserServiceInterface
{
    private EntityRepository $userRepository;
    private PermissionRepositoryInterface $permissionRepository;
    private array $permissionsAdmin = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19];
    private array $permissionsClient = [3, 4, 7, 10, 11, 14, 15, 18, 19];

    public function __construct
    (
        EntityRepository       $userRepository,
        PermissionRepositoryInterface $permissionRepository,
    )
    {
        $this->userRepository       = $userRepository;
        $this->permissionRepository = $permissionRepository;
    }

    public function createUser(CreateUserRequest $request): int
    {
        $user = $this->map($request);
        $userId = $this->userRepository->create($user);
        $permission = $this->createPermission($request->eAdmin, $userId);
        if ($userId && $permission) $this->dispatchJob($request->email, $userId);
        return $userId;
    }

    private function map(CreateUserRequest $request): User
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
                $this->permissionRepository->create($userId, $permission);
            endforeach;
        endif;
            foreach ($this->permissionsClient as $permission):
                $this->permissionRepository->create($userId, $permission);
            endforeach;
        return true;
    }

    private function dispatchJob(string $email, int $userId): void
    {
        EmailForRegisterJob::dispatch($email, $userId);
    }
}
