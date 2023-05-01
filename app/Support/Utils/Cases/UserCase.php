<?php

namespace App\Support\Utils\Cases;

use App\Support\Utils\Enums\UserEnums;

class UserCase
{
    public function genderCase($genero)
    {
        if ($genero == 'Masculino'):
            $genero = UserEnums::GENERO_MASCULINO;
        elseif ($genero == 'Feminino'):
            $genero = UserEnums::GENERO_FEMININO;
        else:
            $genero = UserEnums::GENERO_OUTRO;
        endif;
        return $genero;
    }
}
