<?php

namespace App\Services\Order;

use App\Repositories\CheckRegisterRepository;
use App\Repositories\OrderRepository;
use App\Services\Order\Interfaces\IListOrderService;
use App\Support\Utils\Pagination\Pagination;
use Illuminate\Support\Collection;

class ListOrderService implements IListOrderService
{
    private CheckRegisterRepository $checkRegisterRepository;
    private OrderRepository $orderRepository;

    public function __construct
    (
        CheckRegisterRepository $checkRegisterRepository,
        OrderRepository         $orderRepository
    )
    {
        $this->checkRegisterRepository = $checkRegisterRepository;
        $this->orderRepository         = $orderRepository;
    }

    public function listOrderAll(Pagination $pagination, int $active): Collection
    {
        return $this->orderRepository->getAll($pagination, $active);
    }

    public function listOrderFind(int $id, string $search, int $active): Collection
    {
        if ($id != 0):
            $this->checkRegisterRepository->checkOrderIdExist($id);
        endif;
        return $this->orderRepository->getFind($id, $search, $active);
    }
}
