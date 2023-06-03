<?php

namespace App\Services\Order;

use App\Http\Requests\OrderRequest;
use App\Jobs\EmailCreateOrderJob;
use App\Models\Item;
use App\Models\Pedido;
use App\Repositories\ItemRepository;
use App\Repositories\OrderRepository;
use App\Services\Order\Interfaces\ICreateOrderService;
use App\Support\Utils\Enums\ItemEnum;
use App\Support\Utils\Enums\OrderEnum;

class CreateOrderService implements ICreateOrderService
{
    private int $orderId;
    private Pedido $order;
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
        $this->request = $request;
        $this->order = $this->mapToModelOrder();
        $this->orderId = $this->orderRepository->create($this->order);
        $this->createItems();
        if ($this->orderId and $this->createItems()) $this->dispatchJob();
        return $this->orderId;
    }

    private function mapToModelOrder(): Pedido
    {
        $order = new Pedido();
        $order->numero_pedido = random_int(100000000, 999999999);
        $order->quantidade_item = $this->request->totalItems;
        $order->total = $this->request->total;
        $order->entrega = $this->request->entrega;
        $order->ativo = OrderEnum::ATIVADO;
        $order->usuario_id = $this->request->usuarioId;
        return $order;
    }

    public function createItems(): bool
    {
        foreach ($this->request->items as $item):
            $items = $this->mapToModelItems($item);
            $this->itemRepository->create($items);
        endforeach;
        return true;
    }

    private function mapToModelItems(array $items): Item
    {
        $item = new Item();
        $item->nome = $items['nome'];
        $item->preco = $items['preco'];
        $item->codigo_barra = $items['codigoBarra'];
        $item->quantidade_item = $items['quantidadeItem'];
        $item->sub_total = $items['subTotal'];
        $item->unidade_medida = $items['unidadeMedida'];
        $item->pedido_id = $this->orderId;
        $item->produto_id = $items['produtoId'];
        $item->ativo = ItemEnum::ATIVADO;
        return $item;
    }

    public function dispatchJob(): void
    {
        EmailCreateOrderJob::dispatch($this->order->toArray(), $this->request->items);
    }
}
