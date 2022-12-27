<?php

namespace App\Support\Utils\Cases;

use App\Support\Utils\Enums\UserEnums;

class GenderCase
{
    private string $genero;
    public function genderCase($genero): string
    {
        switch ($genero):
            case $genero === 'Masculino':
                $this->genero = UserEnums::GENERO_MASCULINO;
                break;
            case $genero === 'Feminino':
                $this->genero = UserEnums::GENERO_FEMININO;
                break;
            case $genero === 'Outro':
                $this->genero = UserEnums::GENERO_OUTRO;
                break;
        endswitch;
        return $this->genero;
    }
}
