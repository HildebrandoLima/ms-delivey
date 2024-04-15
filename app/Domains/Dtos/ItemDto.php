<?php

namespace App\Domains\Dtos;

use App\Domains\Traits\Dtos\DefaultFields;

class ItemDto
{
    use DefaultFields;

    public string $nome = "";
    public float $preco = 0;
    public int $quantidadeItem = 0;
    public float $subTotal = 0;
    public int $pedidoId = 0;
    public int $produtoId = 0;

    public function customizeMapping(array $data): void
    {
        $this->mapCommonFields($data);
    }
}
