<?php

namespace App\Services\User\Concretes;

use App\Http\Requests\User\CreateUserRequest;
use App\Jobs\EmailForRegisterJob;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\User\Interfaces\CreateUserServiceInterface;
use App\Support\Permissions\CreatePermissions;
use App\Support\Enums\AtivoEnum;
use Illuminate\Support\Facades\Hash;

class CreateUserService implements CreateUserServiceInterface
{
    private UserRepositoryInterface $userRepository;
    private CreatePermissions       $createPermissions;

    public function __construct
    (
        UserRepositoryInterface $userRepository,
        CreatePermissions       $createPermissions,
    )
    {
        $this->userRepository    = $userRepository;
        $this->createPermissions = $createPermissions;
    }

    public function createUser(CreateUserRequest $request): int
    {
        $user = $this->map($request);
        $userId = $this->userRepository->create($user);
        $this->createPermissions->createPermissions($request->isAdmin, $userId);
        if ($userId) $this->dispatchJob($request->email, $userId);
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
        $user->ativo = AtivoEnum::ATIVADO->value;
        return $user;
    }

    private function dispatchJob(string $email, int $userId): void
    {
        EmailForRegisterJob::dispatch($email, $userId);
    }
}
