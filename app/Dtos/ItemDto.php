<?php

namespace App\Dtos;

use App\Support\Traits\DefaultFields;

class ItemDto 
{
    use DefaultFields;
    public int $id = 0;
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
