<?php

namespace App\Dtos;

use App\Support\Traits\DefaultFields;

class ItemDto 
{
    use DefaultFields;
    public int $itemId = 0;
    public int $quantidadeItem = 0;
    public float $subTotal = 0;
    public int $pedidoId = 0;
    public int $produtoId = 0;
}
