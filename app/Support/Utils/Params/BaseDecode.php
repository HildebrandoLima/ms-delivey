<?php

namespace App\Support\Utils\Params;

final class BaseDecode
{
    final public static function baseDecode(string $id): int
    {
        $id === '' ? $id = 0 : $id = base64_decode($id);
        return $id;
    }
}
