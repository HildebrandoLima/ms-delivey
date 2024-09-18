<?php

namespace App\Support\Utils\PriceFormat;

final class PriceFormat
{
    final public static function priceFormart(string $price): string
    {
        $firstDotPosition = strpos($price, '.');
        if ($firstDotPosition !== false) {
            $price = substr_replace($price, '', $firstDotPosition, 1);
        }
        return $price;
    }
}
