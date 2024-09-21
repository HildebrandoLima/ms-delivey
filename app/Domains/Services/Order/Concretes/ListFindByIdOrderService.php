<?php

namespace App\Domains\Services\Order\Concretes;

use App\Data\Repositories\Order\Concretes\ListFindByIdOrderRepository;
use App\Domains\Services\Order\Interfaces\IListFindByIdOrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ListFindByIdOrderService implements IListFindByIdOrderService
{
    private ListFindByIdOrderRepository $listFindByIdOrderRepository;

    public function __construct(ListFindByIdOrderRepository $listFindByIdOrderRepository)
    {
        $this->listFindByIdOrderRepository = $listFindByIdOrderRepository;
    }

    public function listFindById(Request $request): Collection
    {
        return $this->listFindByIdOrderRepository->listFindById($request->id, (bool)$request->active);
    }
}
