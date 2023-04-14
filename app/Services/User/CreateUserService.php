<?php

namespace App\Services\User;

use App\Exceptions\HttpBadRequest;
use App\Http\Requests\User\CreateUserRequest;
use App\Models\User;
use App\Infra\Database\Dao\User\CreateUserDb;

class CreateUserService
{
    private CreateUserDb $createUserDb;

    public function __construct(CreateUserDb $createUserDb)
    {
        $this->createUserDb = $createUserDb;
    }

    public function createUser(CreateUserRequest $request): int
    {
        $this->checkUser($request);
        return $this->createUserDb->createUser($request);
    }

    private function checkUser($request): void
    {
        if (User::query()->where('name', $request->nome)->orWhere('cpf', $request->cpf)
            ->orWhere('email', $request->email)->count() != 0):
            throw new HttpBadRequest('O usuário já existe');
        endif;
    }
}
