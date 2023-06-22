<?php

namespace App\Services\Order\Concretes;

use App\DataTransferObjects\RequestsDtos\ItemRequestDto;
use App\DataTransferObjects\RequestsDtos\OrderRequestDto;
use App\Http\Requests\OrderRequest;
use App\Jobs\EmailCreateOrderJob;
use App\Repositories\Interfaces\ItemRepositoryInterface;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Services\Order\Interfaces\CreateOrderServiceInterface;

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

    public function createOrder(OrderRequest $request): int
    {
        $order = OrderRequestDto::fromRquest($request);
        $createOrder = $this->orderRepository->create($order);
        $createItem = $this->createItems($request, $createOrder->id);
        if ($createOrder and $createItem) $this->dispatchJob((array)$order, $request->items);
        return $createOrder->id;
    }

    public function createItems(OrderRequest $request, int $orderId): bool
    {
        foreach ($request->items as $item):
            $items = ItemRequestDto::fromRquest($item, $orderId);
            $this->itemRepository->create($items);
        endforeach;
        return true;
    }

    public function dispatchJob(array $order, array $items): void
    {
        EmailCreateOrderJob::dispatch($order, $items);
    }
}
