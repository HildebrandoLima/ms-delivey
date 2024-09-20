<?php

namespace App\Domains\Services\Order\Concretes;

use App\Data\Repositories\Order\Interfaces\ICreateOrderRepository;
use App\Domains\Services\Order\Abstracts\ICreateOrderService;
use App\Http\Requests\Order\CreateOrderRequest;
use App\Jobs\EmailCreateOrderJob;
use App\Jobs\InventoryManagementJob;

class CreateOrderService implements ICreateOrderService
{
    private ICreateOrderRepository $createOrderRepository;

    public function __construct(ICreateOrderRepository $createOrderRepository)
    {
        $this->createOrderRepository = $createOrderRepository;
    }

    public function createOrder(CreateOrderRequest $request): int
    {
        $order = $this->createOrderRepository->create($request);
        if ($order) $this->dispatchJob($order, $request->itens);
        return $order['id'];
    }

    private function dispatchJob(array $order, array $items): void
    {
        InventoryManagementJob::dispatch($items);
        EmailCreateOrderJob::dispatch($order, $items);
    }
}
