<?php

namespace App\Services\User;

use App\Exceptions\HttpBadRequest;
use App\Http\Requests\User\CreateUserRequest;
use App\Models\User;
use App\Support\Utils\Cases\GenderCase;
use App\Infra\Database\Dao\User\CreateUserDb;

class CreateUserService
{
    private GenderCase   $genderCase;
    private CreateUserDb $createUserDb;

    public function __construct
    (
        GenderCase   $genderCase,
        CreateUserDb $createUserDb
    )
    {
        $this->genderCase   = $genderCase;
        $this->createUserDb = $createUserDb;
    }

    public function createUser(CreateUserRequest $request): int
    {
        $this->checkUser($request);
        $genero = $this->genderCase->genderCase($request->genero);
        return $this->createUserDb->createUser($request, $genero);
    }

    private function checkUser($request): void
    {
        if (User::query()->where('cpf', $request->cpf)->count() !== 0):
            throw new HttpBadRequest('O usuário já existe');
        endif;
    }
}
