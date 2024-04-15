<?php

namespace App\Domains\Dtos;

use App\Domains\Traits\Dtos\DefaultFields;

class PaymentDto
{
    use DefaultFields;

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
