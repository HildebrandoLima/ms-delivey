<?php

namespace App\Domains\Services\User\Concretes;

use App\Data\Repositories\Abstracts\IEntityRepository;
use App\Domains\Services\User\Abstracts\ICreateUserService;
use App\Http\Requests\User\CreateUserRequest;
use App\Jobs\EmailForRegisterJob;
use App\Models\User;
use App\Support\Enums\AtivoEnum;
use App\Support\Enums\PerfilEnum;
use Illuminate\Support\Facades\Hash;

class CreateUserService implements ICreateUserService
{
    private IEntityRepository $userRepository;

    public function __construct(IEntityRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createUser(CreateUserRequest $request): int
    {
        $user = $this->mapUser($request);
        $userId = $this->userRepository->create($user);
        if ($userId) $this->dispatchJob($request->email, $userId);
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
        $user->role_id = $request->perfil === 1 ? PerfilEnum::ADMIN : PerfilEnum::CLIENTE;
        $user->ativo = AtivoEnum::ATIVADO;
        return $user;
    }

    private function dispatchJob(string $email, int $userId): void
    {
        EmailForRegisterJob::dispatch($email, $userId);
    }
}
