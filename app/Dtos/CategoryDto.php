<?php

namespace App\Dtos;

use App\Support\Traits\DefaultFields;

class CategoryDto 
{
    use DefaultFields;
    public int $categoriaId = 0;
    public string $nome = "";
}
