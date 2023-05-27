<?php

namespace App\Services\Order;

use App\Http\Requests\OrderRequest;
use App\Jobs\EmailCreateOrderJob;
use App\Models\Item;
use App\Models\Pedido;
use App\Repositories\ItemRepository;
use App\Repositories\OrderRepository;
use App\Services\Order\Interfaces\ICreateOrderService;
use App\Support\Utils\Enums\ProductEnums;

class CreateOrderService implements ICreateOrderService
{
    private OrderRepository $orderRepository;
    private ItemRepository  $itemRepository;

    public function __construct
    (
        OrderRepository $orderRepository,
        ItemRepository  $itemRepository
    )
    {
        $this->orderRepository = $orderRepository;
        $this->itemRepository  = $itemRepository;
    }

    public function createOrder(OrderRequest $request): int
    {
        $order = $this->mapToModelOrder($request);
        $orderId = $this->orderRepository->insert($order);
        foreach ($request->items as $item):
            $items = $this->mapToModelItems($orderId , $item);
            $this->itemRepository->insert($items);
        endforeach;
        EmailCreateOrderJob::dispatch($order->toArray(), $request->items);
        return $orderId;
    }

    private function mapToModelOrder(OrderRequest $request): Pedido
    {
        $order = new Pedido();
        $order->numero_pedido = random_int(100000000, 999999999);
        $order->quantidade_item = $request->totalItems;
        $order->total = $request->total;
        $order->entrega = $request->entrega;
        $order->ativo = ProductEnums::ATIVADO;
        $order->usuario_id = $request->usuarioId;
        return $order;
    }

    private function mapToModelItems(int $orderId, array $items): Item
    {
        $item = new Item();
        $item->nome = $items['nome'];
        $item->preco = $items['preco'];
        $item->codigo_barra = $items['codigoBarra'];
        $item->quantidade_item = $items['quantidadeItem'];
        $item->sub_total = $items['subTotal'];
        $item->unidade_medida = $items['unidadeMedida'];
        $item->pedido_id = $orderId;
        $item->produto_id = $items['produtoId'];
        $item->ativo = ProductEnums::ATIVADO;
        return $item;
    }
}
