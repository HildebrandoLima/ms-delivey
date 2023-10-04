<?php

namespace App\Dtos;

use App\Support\Traits\DefaultFields;

class PaymentDto
{
    use DefaultFields;
    public int $pagamentoId = 0;
    public int $codigoTransacao = 0;
    public string|null $numeroCartao = "";
    public string|null $tipoCartao = "";
    public int|null $ccv = 0;
    public string|null $dataValidade = "";
    public int|null $parcela = 0;
    public float $total = 0;
    public int $metodoPagamentoId = 0;
    public int $pedidoId = 0;
}
