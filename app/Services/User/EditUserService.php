<?php

namespace App\Services\User;

use App\Http\Requests\User\EditUserRequest;
use App\Support\Utils\Cases\GenderCase;
use App\Infra\Database\Dao\User\EditUserDb;

class EditUserService
{
    private GenderCase   $genderCase;
    private EditUserDb   $editUserDb;

    public function __construct
    (
        GenderCase   $genderCase,
        EditUserDb   $editUserDb
    )
    {
        $this->genderCase   = $genderCase;
        $this->editUserDb   = $editUserDb;
    }

    public function editUser(EditUserRequest $request): bool
    {
        $genero = $this->genderCase->genderCase($request->genero);
        return $this->editUserDb->editUser($request, $genero);
    }
}
