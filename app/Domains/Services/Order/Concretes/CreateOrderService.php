<?php

namespace App\Domains\Services\Order\Concretes;

use App\Data\Repositories\Order\Interfaces\ICreateOrderRepository;
use App\Domains\Services\Order\Interfaces\ICreateOrderService;
use App\Domains\Traits\RequestConfigurator;
use App\Http\Requests\Order\CreateOrderRequest;
use App\Jobs\EmailCreateOrderJob;
use App\Jobs\InventoryManagementJob;

class CreateOrderService implements ICreateOrderService
{
    use RequestConfigurator;
    private ICreateOrderRepository $createOrderRepository;
    private array $order = [];

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
        InventoryManagementJob::dispatch($this->request->itens);
        EmailCreateOrderJob::dispatch($this->order, $this->request->itens);
    }
}
