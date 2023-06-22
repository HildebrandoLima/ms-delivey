<?php

namespace App\Services\Order\Concretes;

use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Services\Order\Interfaces\ListOrderServiceInterface;
use Illuminate\Support\Collection;

class ListOrderService implements ListOrderServiceInterface
{
    private CheckEntityRepositoryInterface $checkEntityRepositoryInterface;
    private OrderRepositoryInterface       $orderRepositoryInterface;

    public function __construct
    (
        CheckEntityRepositoryInterface $checkEntityRepositoryInterface,
        OrderRepositoryInterface       $orderRepositoryInterface,
    )
    {
        $this->checkEntityRepositoryInterface = $checkEntityRepositoryInterface;
        $this->orderRepositoryInterface       = $orderRepositoryInterface;
    }

    public function listOrderAll(int $active): Collection
    {
        return $this->orderRepositoryInterface->getAll($active);
    }

    public function listOrderFind(int $id, string $search, int $active): Collection
    {
        if ($id != 0) $this->checkEntityRepositoryInterface->checkOrderIdExist($id);
        return $this->orderRepositoryInterface->getOne($id, $search, $active);
    }
}
