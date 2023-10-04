<?php

namespace App\Dtos;

use App\Support\Traits\DefaultFields;

class OrderDto 
{
    use DefaultFields;
    public int $pedidoId = 0;
    public int $numeroPedido = 0;
    public int $quantidadeItem = 0;
    public float $total = 0;
    public string $tipoEntrega = "";
    public float $valorEntrega = 0;
    public int $usuarioId = 0;
    public int $enderecoId = 0;
    public array $itens = [];
    public array $pagamento = [];
}
