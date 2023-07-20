<?php

namespace App\Support\Utils\Cases;

use App\Support\Utils\Enums\UserEnum;

class UserCase
{
    public static function genderCase($genero): string
    {
        switch ($genero):
            case $genero == 'Masculino':
                $genero = UserEnum::GENERO_MASCULINO;
            break;
            case $genero == 'Feminino':
                $genero = UserEnum::GENERO_FEMININO;
            break;
            default:
                $genero = UserEnum::GENERO_OUTRO;
        endswitch;
        return $genero;
    }
}
