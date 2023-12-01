<?php

namespace App\Dtos;

use App\Support\Traits\DefaultFields;

class ImageDto
{
    use DefaultFields;
    public string $caminho = "";
    public int $produtoId = 0;

    public function customizeMapping(array $data): void
    {
        $this->mapCommonFields($data);
    }
}
