<?php

namespace App\Support\Utils\Cases;

use App\Support\Utils\Enums\ProductEnum;

class ProductCase
{
    public static function productCase($parameter): string
    {
        array_filter(ProductEnum::UNIDADE_MEDIDA, function ($value) use ($parameter) {
            if ($value == $parameter):
                $parameter = $parameter;
            endif;
        });
        return (string)$parameter;
    }
}
