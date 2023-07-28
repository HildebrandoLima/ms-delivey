<?php

namespace App\Services\User\Concretes;

use App\Http\Requests\User\CreateUserRequest;
use App\Jobs\EmailForRegisterJob;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\User\Interfaces\CreateUserServiceInterface;
use App\Support\Permissions\CreatePermissions;
use App\Support\Cases\UserCase;
use App\Support\Enums\UserEnum;
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
        $this->createPermissions->createPermissions($request->perfil, $userId);
        if ($userId) $this->dispatchJob($request->email, $userId);
        return $userId;
    }

    private function map(CreateUserRequest $request): User
    {
        $user = new User();
        $user->name = $request->nome;
        $user->cpf = str_replace(array('.','-','/'), "", $request->cpf);
        $user->email = $request->email;
        $user->password = Hash::make($request->senha);
        $user->data_nascimento = $request->dataNascimento;
        $user->genero = UserCase::genderCase($request->genero);
        $user->is_admin = $request->perfil;
        $user->ativo = UserEnum::ATIVADO;
        return $user;
    }

    private function dispatchJob(string $email, int $userId): void
    {
        EmailForRegisterJob::dispatch($email, $userId);
    }
}
