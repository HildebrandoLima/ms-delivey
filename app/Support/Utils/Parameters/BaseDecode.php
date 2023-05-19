<?php

namespace App\Support\Utils\Parameters;

class BaseDecode
{
    private int $id;

    public function baseDecode(string $id): int
    {
        $this->id = base64_decode($id);
        return $this->id;
    }
}
