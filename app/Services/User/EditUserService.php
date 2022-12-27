<?php

namespace App\Services\User;

use App\Http\Requests\User\EditUserRequest;
use App\Support\Utils\Cases\GenderCase;
use App\Support\Utils\Cases\ActivityCase;
use App\Infra\Database\Dao\User\EditUserDb;

class EditUserService
{
    private GenderCase   $genderCase;
    private ActivityCase $activityCase;
    private EditUserDb   $editUserDb;

    public function __construct
    (
        GenderCase   $genderCase,
        ActivityCase $activityCase,
        EditUserDb   $editUserDb
    )
    {
        $this->genderCase   = $genderCase;
        $this->activityCase = $activityCase;
        $this->editUserDb   = $editUserDb;
    }

    public function editUser(EditUserRequest $request): bool
    {
        $atividade = $this->activityCase->activityCase($request->atividade);
        $genero = $this->genderCase->genderCase($request->genero);
        return $this->editUserDb->editUser($request, $atividade, $genero);
    }
}
