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

    public function __construct
    (
        int $pagamentoId,
        int $codigoTransacao,
        string|null $numeroCartao,
        string|null $dataValidade,
        int|null $parcela,
        float $total,
        int $metodoPagamentoId,
        int $pedidoId,
        string $ativo,
        string $criadoEm,
        string $aleradoEm
    )
    {
        $this->setPagamentoId($pagamentoId);
        $this->setCodigoTransacao($codigoTransacao);
        $this->setNumeroCartao($numeroCartao);
        $this->setDataValidade($dataValidade);
        $this->setParcela($parcela);
        $this->setTotal($total);
        $this->setMetodoPagamentoId($metodoPagamentoId);
        $this->setPedidoId($pedidoId);
        $this->setAtivo($ativo);
        $this->setCriadoEm($criadoEm);
        $this->setAlteradoEm($aleradoEm);
    }

    public function getPagamentoId(): int
    {
        return $this->pagamentoId;
    }

    public function setPagamentoId(int $pagamentoId): void
    {
        $this->pagamentoId = $pagamentoId;
    }

    public function getCodigoTransacao(): int
    {
        return $this->codigoTransacao;
    }

    public function setCodigoTransacao(int $codigoTransacao): void
    {
        $this->codigoTransacao = $codigoTransacao;
    }

    public function getNumeroCartao(): string|null
    {
        return $this->numeroCartao;
    }

    public function setNumeroCartao(string|null $numeroCartao): void
    {
        $this->numeroCartao = $numeroCartao;
    }

    public function getDataValidade(): string|null
    {
        return $this->dataValidade;
    }

    public function setDataValidade(string|null $dataValidade): void
    {
        $this->dataValidade = $dataValidade;
    }

    public function getParcela(): int|null
    {
        return $this->parcela;
    }

    public function setParcela(int|null $parcela): void
    {
        $this->parcela = $parcela;
    }

    public function getTotal(): float
    {
        return $this->total;
    }

    public function setTotal(float $total): void
    {
        $this->total = $total;
    }

    public function getMetodoPagamentoId(): int
    {
        return $this->metodoPagamentoId;
    }

    public function setMetodoPagamentoId(int $metodoPagamentoId): void
    {
        $this->metodoPagamentoId = $metodoPagamentoId;
    }

    public function getPedidoId(): int
    {
        return $this->pedidoId;
    }

    public function setPedidoId(int $pedidoId): void
    {
        $this->pedidoId = $pedidoId;
    }
}
