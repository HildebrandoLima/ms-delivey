<?php

namespace App\Dtos;

use App\Support\Traits\DefaultFields;

class CategoryDto 
{
    use DefaultFields;
    public int $id = 0;
    public string $nome = "";

    public function customizeMapping(array $data): void
    {
        $this->mapCommonFields($data);
    }
}
