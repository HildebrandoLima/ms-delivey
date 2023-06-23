<?php

namespace App\DataTransferObjects\Dtos;

class PaymentDto extends DefaultFields
{
    public int $pagamento_id;
    public int $codigo_transacao;
    public string|null $numero_cartao;
    public string|null $data_validade;
    public int|null $parcela;
    public float $total;
    public int $metodo_pagamento_id;
    public int $pedido_id;

    public static function construction(): static
    {
        return new PaymentDto();
    }

    public function getPagamentoId(): int
    {
        return $this->pagamento_id;
    }

    public function setPagamentoId(int $pagamento_id): PaymentDto
    {
        $this->pagamento_id = $pagamento_id;
        return $this;
    }

    public function getCodigoTransacao(): int
    {
        return $this->codigo_transacao;
    }

    public function setCodigoTransacao(int $codigo_transacao): PaymentDto
    {
        $this->codigo_transacao = $codigo_transacao;
        return $this;
    }

    public function getNumeroCartao(): string|null
    {
        return $this->numero_cartao;
    }

    public function setNumeroCartao(string|null $numero_cartao): PaymentDto
    {
        $this->numero_cartao = $numero_cartao;
        return $this;
    }

    public function getDataValidade(): string|null
    {
        return $this->data_validade;
    }

    public function setDataValidade(string|null $data_validade): PaymentDto
    {
        $this->data_validade = $data_validade;
        return $this;
    }

    public function getParcela(): int|null
    {
        return $this->parcela;
    }

    public function setParcela(int|null $parcela): PaymentDto
    {
        $this->parcela = $parcela;
        return $this;
    }

    public function getTotal(): float
    {
        return $this->total;
    }

    public function setTotal(float $total): PaymentDto
    {
        $this->total = $total;
        return $this;
    }

    public function getMetodoPagamentoId(): int
    {
        return $this->metodo_pagamento_id;
    }

    public function setMetodoPagamentoId(int $metodo_pagamento_id): PaymentDto
    {
        $this->metodo_pagamento_id = $metodo_pagamento_id;
        return $this;
    }

    public function getPedidoId(): int
    {
        return $this->pedido_id;
    }

    public function setPedidoId(int $pedido_id): PaymentDto
    {
        $this->pedido_id = $pedido_id;
        return $this;
    }
}
