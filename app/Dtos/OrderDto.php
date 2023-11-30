<?php

namespace App\Dtos;

use App\Support\MapperEntity\EntityOrder;
use App\Support\MapperEntity\EntityPerson;
use App\Support\Traits\DefaultFields;

class OrderDto 
{
    use DefaultFields;
    public int $id = 0;
    public int $numeroPedido = 0;
    public int $quantidadeItem = 0;
    public float $total = 0;
    public string $tipoEntrega = "";
    public float $valorEntrega = 0;
    public int $usuarioId = 0;
    public array $itens = [];
    public array $pagamento = [];
    public array $endereco = [];

    public function customizeMapping(array $data): void
    {
        $this->mapCommonFields($data);
        $this->itens = EntityOrder::items($data['item'] ?? []) ?? [];
        $this->pagamento = EntityOrder::payment($data['pagamento'] ?? []) ?? [];
        $this->endereco = EntityPerson::addrres($data['endereco'] ?? '') ?? [];
    }
}
