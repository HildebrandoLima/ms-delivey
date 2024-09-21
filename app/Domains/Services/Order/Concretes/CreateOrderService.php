<?php

namespace App\Domains\Services\Order\Concretes;

use App\Data\Repositories\Order\Interfaces\ICreateOrderRepository;
use App\Domains\Services\Order\Interfaces\ICreateOrderService;
use App\Http\Requests\Order\CreateOrderRequest;
use App\Jobs\EmailCreateOrderJob;
use App\Jobs\InventoryManagementJob;

class CreateOrderService implements ICreateOrderService
{
    private ICreateOrderRepository $createOrderRepository;
    private CreateOrderRequest $request;
    private array $order = [], $items = [];

    public function __construct(ICreateOrderRepository $createOrderRepository)
    {
        $this->createOrderRepository = $createOrderRepository;
    }

    public function create(CreateOrderRequest $request): int
    {
        $this->setRequest($request);
        $this->created();
        $this->check();
        return $this->order['id'];
    }

    private function setRequest(CreateOrderRequest $request): void
    {
        $this->request = $request;
        $this->items = $request->itens;
    }

    private function created(): void
    {
        $this->order = $this->createOrderRepository->create($this->request);
    }

    private function check(): void
    {
        if ($this->order) $this->dispatchJob();
    }

    private function dispatchJob(): void
    {
        InventoryManagementJob::dispatch($this->items);
        EmailCreateOrderJob::dispatch($this->order, $this->items);
    }
}
