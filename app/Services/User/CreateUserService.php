<?php

namespace App\Services\User;

use App\Http\Requests\User\CreateUserRequest;
use App\Infra\Database\Dao\User\CreateUserDb;
use App\Support\Utils\Enums\UserEnums;

class CreateUserService
{
    private CreateUserDb $createUserDb;

    public function __construct(CreateUserDb $createUserDb)
    {
        $this->createUserDb = $createUserDb;
    }

    public function createUser(CreateUserRequest $request): int
    {
        $genero = $this->caseGenero($request->genero);
        return $this->createUserDb->createUser($request, $genero);
    }

    private function caseGenero($genero): string
    {
        switch ($genero):
            case $genero === 'Masculino':
                return UserEnums::GENERO_MASCULINO;
            case $genero === 'Feminino':
                return UserEnums::GENERO_FEMININO;
            case $genero === 'Outro':
                return UserEnums::GENERO_OUTRO;
        endswitch;
    }
}
