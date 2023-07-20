<?php

namespace App\DataTransferObjects\Dtos;

class PaymentDto extends DefaultFields
{
    public int $pagamentoId;
    public int $codigoTransacao;
    public string|null $numeroCartao;
    public string|null $dataValidade;
    public int|null $parcela;
    public float $total;
    public int $metodoPagamentoId;
    public int $pedidoId;

    public static function construction(): static
    {
        return new PaymentDto();
    }

    public function getPagamentoId(): int
    {
        return $this->pagamentoId;
    }

    public function setPagamentoId(int $pagamentoId): PaymentDto
    {
        $this->pagamentoId = $pagamentoId;
        return $this;
    }

    public function getCodigoTransacao(): int
    {
        return $this->codigoTransacao;
    }

    public function setCodigoTransacao(int $codigoTransacao): PaymentDto
    {
        $this->codigoTransacao = $codigoTransacao;
        return $this;
    }

    public function getNumeroCartao(): string|null
    {
        return $this->numeroCartao;
    }

    public function setNumeroCartao(string|null $numeroCartao): PaymentDto
    {
        $this->numeroCartao = $numeroCartao;
        return $this;
    }

    public function getDataValidade(): string|null
    {
        return $this->dataValidade;
    }

    public function setDataValidade(string|null $dataValidade): PaymentDto
    {
        $this->dataValidade = $dataValidade;
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
        return $this->metodoPagamentoId;
    }

    public function setMetodoPagamentoId(int $metodoPagamentoId): PaymentDto
    {
        $this->metodoPagamentoId = $metodoPagamentoId;
        return $this;
    }

    public function getPedidoId(): int
    {
        return $this->pedidoId;
    }

    public function setPedidoId(int $pedidoId): PaymentDto
    {
        $this->pedidoId = $pedidoId;
        return $this;
    }
}
