<?php

namespace App\Services\User;

use App\Http\Requests\User\EditUserRequest;
use App\Infra\Database\Dao\User\EditUserDb;
use App\Support\Utils\Enums\UserEnums;

class EditUserService
{
    private EditUserDb $editUserDb;

    public function __construct(EditUserDb $editUserDb)
    {
        $this->editUserDb = $editUserDb;
    }

    public function editUser(EditUserRequest $request): bool
    {
        $atividade = $this->caseAtividade($request->atividade);
        $genero = $this->caseGenero($request->genero);
        return $this->editUserDb->editUser($request, $atividade, $genero);
    }

    private function caseAtividade($atividade): string
    {
        switch ($atividade):
            case $atividade === '0':
                return UserEnums::DESATIVADO;
            case $atividade === '1':
                return UserEnums::ATIVADO;
        endswitch;
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
