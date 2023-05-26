<?php

namespace App\Services\Order;

use App\Http\Requests\OrderRequest;
use App\Models\Pedido;
use App\Repositories\OrderRepository;
use App\Services\Order\Interfaces\ICreateOrderService;
use App\Support\Utils\Enums\ProductEnums;

class CreateOrderService implements ICreateOrderService
{
    private OrderRepository $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function createOrder(OrderRequest $request): int
    {
        $order = $this->mapToModel($request);
        return $this->orderRepository->insert($order);
    }

    private function mapToModel(OrderRequest $request): Pedido
    {
        $order = new Pedido();
        $order->numero_pedido = random_int(100000000, 999999999);
        $order->quantidade_item = $request->quantidadeItem;
        $order->total = $request->total;
        $order->entrega = $request->entrega;
        $order->ativo = ProductEnums::ATIVADO;
        $order->usuario_id = $request->usuarioId;
        return $order;
    }
}
