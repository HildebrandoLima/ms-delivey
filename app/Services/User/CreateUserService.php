<?php

namespace App\Services\User;

use App\Http\Requests\UserRequest;
use App\Jobs\EmailForRegisterJob;
use App\Models\User;
use App\Repositories\CheckRegisterRepository;
use App\Repositories\UserRepository;
use App\Services\User\Interfaces\ICreateUserService;
use App\Support\Utils\Cases\UserCase;
use App\Support\Utils\Enums\UserEnum;
use Illuminate\Support\Facades\Hash;

class CreateUserService implements ICreateUserService
{
    private UserCase $userCase;
    private CheckRegisterRepository $checkRegisterRepository;
    private UserRepository $userRepository;

    public function __construct
    (
        UserCase                $userCase,
        CheckRegisterRepository $checkRegisterRepository,
        UserRepository          $userRepository
    )
    {
        $this->userCase                = $userCase;
        $this->checkRegisterRepository = $checkRegisterRepository;
        $this->userRepository          = $userRepository;
    }

    public function createUser(UserRequest $request): int
    {
        $this->request = $request;
        $this->checkExist();
        $user = $this->mapToModel();
        $userId = $this->userRepository->create($user);
        if ($userId) $this->dispatchJob($userId->id);
        return $userId->id;
    }

    public function checkExist(): void
    {
        $this->checkRegisterRepository->checkUserExist($this->request);
    }

    private function mapToModel(): User
    {
        $user = new User();
        $user->name = $this->request->nome;
        $user->cpf = str_replace(array('.','-','/'), "", $this->request->cpf);
        $user->email = $this->request->email;
        $user->password = Hash::make($this->request->senha);
        $user->data_nascimento = $this->request->dataNascimento;
        $user->genero = $this->userCase->genderCase($this->request->genero);
        $user->ativo = UserEnum::ATIVADO;
        return $user;
    }

    public function dispatchJob(int $userId): void
    {
        $entity = 'user';
        EmailForRegisterJob::dispatch($this->request->email, $userId, $entity);
    }
}
