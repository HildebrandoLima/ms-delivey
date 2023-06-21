<?php

namespace App\Services\Order;

use App\DataTransferObjects\RequestsDtos\ItemRequestDto;
use App\DataTransferObjects\RequestsDtos\OrderRequestDto;
use App\Http\Requests\OrderRequest;
use App\Jobs\EmailCreateOrderJob;
use App\Repositories\Interfaces\ItemRepositoryInterface;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Services\Order\Interfaces\ICreateOrderService;

class CreateOrderService implements ICreateOrderService
{
    private OrderRepositoryInterface $orderRepositoryInterface;
    private ItemRepositoryInterface  $itemRepositoryInterface;

    public function __construct
    (
        OrderRepositoryInterface $orderRepositoryInterface,
        ItemRepositoryInterface  $itemRepositoryInterface,
    )
    {
        $this->orderRepositoryInterface = $orderRepositoryInterface;
        $this->itemRepositoryInterface  = $itemRepositoryInterface;
    }

    public function createOrder(OrderRequest $request): int
    {
        $order = OrderRequestDto::fromRquest($request);
        $createOrder = $this->orderRepositoryInterface->create($order);
        $createItem = $this->createItems($request, $createOrder->id);
        if ($createOrder and $createItem) $this->dispatchJob((array)$order, $request->items);
        return $createOrder->id;
    }

    public function createItems(OrderRequest $request, int $orderId): bool
    {
        foreach ($request->items as $item):
            $items = ItemRequestDto::fromRquest($item, $orderId);
            $this->itemRepositoryInterface->create($items);
        endforeach;
        return true;
    }

    public function dispatchJob(array $order, array $items): void
    {
        EmailCreateOrderJob::dispatch($order, $items);
    }
}
