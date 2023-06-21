<?php

namespace App\Services\Order;

use App\Repositories\CheckRegisterRepository;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Services\Order\Interfaces\IListOrderService;
use Illuminate\Support\Collection;

class ListOrderService implements IListOrderService
{
    private CheckRegisterRepository  $checkRegisterRepository;
    private OrderRepositoryInterface $orderRepositoryInterface;

    public function __construct
    (
        CheckRegisterRepository  $checkRegisterRepository,
        OrderRepositoryInterface $orderRepositoryInterface,
    )
    {
        $this->checkRegisterRepository  = $checkRegisterRepository;
        $this->orderRepositoryInterface = $orderRepositoryInterface;
    }

    public function listOrderAll(int $active): Collection
    {
        return $this->orderRepositoryInterface->getAll($active);
    }

    public function listOrderFind(int $id, string $search, int $active): Collection
    {
        if ($id != 0) $this->checkRegisterRepository->checkOrderIdExist($id);
        return $this->orderRepositoryInterface->getOne($id, $search, $active);
    }
}
