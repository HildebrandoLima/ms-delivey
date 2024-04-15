<?php

namespace App\Domains\Dtos;

use App\Support\Traits\DefaultFields;
use App\Support\Utils\MapperDtos\EntityOrder;
use App\Support\Utils\MapperDtos\EntityPerson;

class OrderDto
{
    use DefaultFields, EntityOrder, EntityPerson;

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
        $this->itens = $this->items($data['item'] ?? []);
        $this->pagamento = $this->payment($data['pagamento'] ?? []);
        $this->endereco = $this->address($data['endereco'] ?? []);
    }
}
