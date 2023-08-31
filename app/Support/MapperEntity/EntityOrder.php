<?php

namespace App\Support\MapperEntity;

use App\Dtos\ItemDto;
use App\Dtos\PaymentDto;
use App\Support\Utils\DateFormat\DateFormat;

class EntityOrder
{
    public static function items(array $items): array
    {
        foreach ($items as $key => $instance):
            $items[$key] = self::mapItems($instance);
        endforeach;
        return $items;
    }

    private static function mapItems(array $data): ItemDto
    {
        $item = new ItemDto();
        $item->itemId = $data['id'];
        $item->nome = $data['nome'];
        $item->preco = $data['preco'];
        $item->codigoBarra = $data['codigo_barra'];
        $item->quantidadeItem = $data['quantidade_item'];
        $item->subTotal = $data['sub_total'];
        $item->unidadeMedida = $data['unidade_medida'];
        $item->pedidoId = $data['pedido_id'];
        $item->produtoId = $data['produto_id'];
        $item->ativo = $data['ativo'];
        $item->criadoEm = DateFormat::dateFormat($data['created_at']);
        $item->alteradoEm = DateFormat::dateFormat($data['updated_at']);
        return $item;
    }

    public static function payment(array $pagamento): array
    {
        foreach ($pagamento as $key => $instance):
            $pagamento[$key] = self::mapPayment($instance);
        endforeach;
        return $pagamento;
    }

    private static function mapPayment(array $data): PaymentDto
    {
        $payment = new PaymentDto();
        $payment->pagamentoId = $data['id'];
        $payment->codigoTransacao = $data['codigo_transacao'];
        $payment->numeroCartao = $data['numero_cartao'];
        $payment->ccv = $data['ccv'];
        $payment->parcela = $data['parcela'];
        $payment->total = $data['total'];
        $payment->metodoPagamentoId = $data['metodo_pagamento_id'];
        $payment->pagamentoId = $data['id'];
        $payment->pedidoId = $data['pedido_id'];
        $payment->ativo = $data['ativo'];
        $payment->criadoEm = DateFormat::dateFormat($data['created_at']);
        $payment->alteradoEm = DateFormat::dateFormat($data['updated_at']);
        return $payment;
    }
}
