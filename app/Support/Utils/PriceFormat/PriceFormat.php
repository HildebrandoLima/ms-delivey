<?php

namespace App\Support\Utils\PriceFormat;

final class PriceFormat
{
    final public static function priceFormart(string $price): string
    {
        $firstDotPosition = strpos($price, '.');
        $price = $firstDotPosition !== false ? substr_replace($price, '', $firstDotPosition, 1) : $price;
        return $price;
    }
}
