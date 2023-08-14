<?php

namespace App\Dtos;

use App\Support\Traits\DefaultFields;

class TelephoneDto
{
    use DefaultFields;
    public int $telefoneId = 0;
    public string $numero = "";
    public string $tipo = "";
    public int|null $usuarioId = 0;
    public int|null $fornecedorId = 0;
}
