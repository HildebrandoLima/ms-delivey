<?php

namespace App\Services\Order\Concretes;

use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Services\Order\Interfaces\ListOrderServiceInterface;
use App\Support\Permissions\ValidationPermission;
use App\Support\Enums\PermissionEnum;
use Illuminate\Support\Collection;

class ListOrderService extends ValidationPermission implements ListOrderServiceInterface
{
    private CheckEntityRepositoryInterface $checkEntityRepository;
    private OrderRepositoryInterface       $orderRepository;

    public function __construct
    (
        CheckEntityRepositoryInterface $checkEntityRepository,
        OrderRepositoryInterface       $orderRepository,
    )
    {
        $this->checkEntityRepository = $checkEntityRepository;
        $this->orderRepository       = $orderRepository;
    }

    public function listOrderAll(int $id, int $active): Collection
    {
        $this->validationPermission(PermissionEnum::LISTAR_PEDIDOS);
        return $this->orderRepository->getAll($id, $active);
    }

    public function listOrderFind(int $id, string $search, int $active): Collection
    {
        $this->validationPermission(PermissionEnum::LISTAR_DETALHES_PEDIDO);
        if ($id != 0) $this->checkEntityRepository->checkOrderIdExist($id);
        return $this->orderRepository->getOne($id, $search, $active);
    }
}
