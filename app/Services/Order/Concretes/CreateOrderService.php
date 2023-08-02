<?php

namespace App\Services\Order\Concretes;

use App\Http\Requests\Order\CreateOrderRequest;
use App\Jobs\EmailCreateOrderJob;
use App\Models\Item;
use App\Models\Pedido;
use App\Repositories\Interfaces\ItemRepositoryInterface;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Services\Order\Interfaces\CreateOrderServiceInterface;
use App\Support\Enums\AtivoEnum;

class CreateOrderService implements CreateOrderServiceInterface
{
    private OrderRepositoryInterface $orderRepository;
    private ItemRepositoryInterface  $itemRepository;

    public function __construct
    (
        OrderRepositoryInterface $orderRepository,
        ItemRepositoryInterface  $itemRepository,
    )
    {
        $this->orderRepository = $orderRepository;
        $this->itemRepository  = $itemRepository;
    }

    public function createOrder(CreateOrderRequest $request): bool
    {
        $order = $this->mapOrder($request);
        $orderId = $this->orderRepository->create($order);
        $createItem = $this->createItem($request, $orderId);
        if ($orderId and $createItem) $this->dispatchJob($order->toArray(), $request->itens);
        return true;
    }

    private function mapOrder(CreateOrderRequest $request): Pedido
    {
        $order = new Pedido();
        $order->numero_pedido = random_int(100000000, 999999999);
        $order->quantidade_item = $request->quantidadeItens;
        $order->total = $request->total;
        $order->entrega = $request->entrega;
        $order->usuario_id = $request->usuarioId;
        $order->ativo = AtivoEnum::ATIVADO;
        return $order;
    }

    public function createItem(CreateOrderRequest $request, int $orderId): bool
    {
        foreach ($request->itens as $item):
            $items = $this->mapItem($item, $orderId);
            $this->itemRepository->create($items);
        endforeach;
        return true;
    }

    private function mapItem(array $item, int $orderId): Item
    {
        
        $itens = new Item();
        $itens->nome = $item['nome'];
        $itens->preco = $item['preco'];
        $itens->codigo_barra = $item['codigoBarra'];
        $itens->quantidade_item = $item['quantidadeItem'];
        $itens->sub_total = $item['subTotal'];
        $itens->unidade_medida = $item['unidadeMedida'];
        $itens->pedido_id = $orderId;
        $itens->produto_id = $item['produtoId'];
        $itens->ativo = AtivoEnum::ATIVADO;
        return $itens;
    }

    public function dispatchJob(array $order, array $items): void
    {
        EmailCreateOrderJob::dispatch($order, $items);
    }
}
