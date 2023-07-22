<?php

namespace App\Support\Utils\Parameters;

final class Search
{
    final public static function search(string $search): string
    {
        $search === '' ? $search = '' : $search = '%' . $search . '%';
        return $search;
    }
}
