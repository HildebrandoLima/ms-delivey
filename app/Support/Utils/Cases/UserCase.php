<?php

namespace App\Support\Utils\Cases;

use App\Support\Utils\Enums\UserEnums;

class UserCase
{
    public function genderCase($genero): string
    {
        switch ($genero):
            case $genero == 'Masculino':
                $genero = UserEnums::GENERO_MASCULINO;
            break;
            case $genero == 'Feminino':
                $genero = UserEnums::GENERO_FEMININO;
            break;
            default:
                $genero = UserEnums::GENERO_OUTRO;
        endswitch;
        return $genero;
    }
}
