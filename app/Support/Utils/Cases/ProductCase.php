<?php

namespace App\Support\Utils\Cases;

use App\Support\Utils\Enums\ProductEnums;

class ProductCase
{
    public function productCase($unidadeMedida): string
    {
        switch ($unidadeMedida):
            case $unidadeMedida == 'UN':
                $unidadeMedida = ProductEnums::UNIDADE_MEDIDA[0];
            break;
            case $unidadeMedida == 'G':
                $unidadeMedida = ProductEnums::UNIDADE_MEDIDA[1];
            break;
            case $unidadeMedida == 'KG':
                $unidadeMedida = ProductEnums::UNIDADE_MEDIDA[2];
            break;
            case $unidadeMedida == 'ML':
                $unidadeMedida = ProductEnums::UNIDADE_MEDIDA[3];
            break;
            case $unidadeMedida == 'L':
                $unidadeMedida = ProductEnums::UNIDADE_MEDIDA[4];
            break;
            case $unidadeMedida == 'M2':
                $unidadeMedida = ProductEnums::UNIDADE_MEDIDA[5];
            break;
            case $unidadeMedida == 'CX':
                $unidadeMedida = ProductEnums::UNIDADE_MEDIDA[6];
            break;
        endswitch;
        return $unidadeMedida;
    }
}
