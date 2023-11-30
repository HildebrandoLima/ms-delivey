<?php

namespace App\Support\Utils\PriceFormat;

final class PriceFormat
{
    final public static function priceFormart(string $preco): string
    {
        $firstDotPosition = strpos($preco, '.');
        if ($firstDotPosition !== false):
            $preco = substr_replace($preco, '', $firstDotPosition, 1);
        endif;
        return $preco;
    }
}
