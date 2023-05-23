<?php

namespace App\Support\Utils\Cases;

use App\Support\Utils\Enums\ProductEnums;

class ProductCase
{
    private string $unidadeMedida;

    public function productCase($parameter): string
    {
        array_filter(ProductEnums::UNIDADE_MEDIDA, function ($value) use ($parameter) {
            if ($value == $parameter):
                $this->unidadeMedida = $parameter;
            endif;
        });
        return $this->unidadeMedida;
    }
}
