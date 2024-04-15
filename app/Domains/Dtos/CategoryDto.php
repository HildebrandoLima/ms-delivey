<?php

namespace App\Domains\Dtos;

use App\Domains\Traits\Dtos\DefaultFields;

class CategoryDto
{
    use DefaultFields;

    public string $nome = "";

    public function customizeMapping(array $data): void
    {
        $this->mapCommonFields($data);
    }
}
