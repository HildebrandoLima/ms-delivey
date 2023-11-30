<?php

namespace App\Dtos;

use App\Support\Traits\DefaultFields;

class PaymentDto
{
    use DefaultFields;
    public int $id = 0;
    public int $codigoTransacao = 0;
    public ?string $numeroCartao = "";
    public ?string $tipoCartao = "";
    public ?int $ccv = 0;
    public ?string $dataValidade = "";
    public ?int $parcela = 0;
    public float $total = 0;
    public string $metodoPagamento = "";
    public int $pedidoId = 0;

    public function customizeMapping(array $data): void
    {
        $this->mapCommonFields($data);
    }
}
