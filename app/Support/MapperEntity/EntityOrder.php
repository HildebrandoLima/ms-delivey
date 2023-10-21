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
        $item->itemId = $data['id'] ?? 0;
        $item->nome = $data['nome'] ?? '';
        $item->preco = $data['preco'] ?? 0;
        $item->quantidadeItem = $data['quantidade_item'] ?? 0;
        $item->subTotal = $data['sub_total'] ?? 0;
        $item->pedidoId = $data['pedido_id'] ?? 0;
        $item->produtoId = $data['produto_id'] ?? 0;
        $item->ativo = $data['ativo'] ?? '';
        $item->criadoEm = DateFormat::dateFormat($data['created_at'] ?? '') ?? '';
        $item->alteradoEm = DateFormat::dateFormat($data['updated_at'] ?? '') ?? '';
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
        $payment->pagamentoId = $data['id'] ?? 0;
        $payment->codigoTransacao = $data['codigo_transacao'] ?? 0;
        $payment->numeroCartao = $data['numero_cartao'] ?? '';
        $payment->tipoCartao = $data['tipo_cartao'] ?? '';
        $payment->ccv = $data['ccv'] ?? 0;
        $payment->parcela = $data['parcela'] ?? 0;
        $payment->total = $data['total'] ?? 0;
        $payment->metodoPagamento = $data['metodo_pagamento'] ?? '';
        $payment->pedidoId = $data['pedido_id'] ?? 0;
        $payment->ativo = $data['ativo'] ?? '';
        $payment->criadoEm = DateFormat::dateFormat($data['created_at'] ?? '') ?? '';
        $payment->alteradoEm = DateFormat::dateFormat($data['updated_at'] ?? '') ?? '';
        return $payment;
    }
}
