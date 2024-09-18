<?php

namespace App\Domains\Services\Order\Concretes;

use App\Data\Repositories\Abstracts\IOrderRepository;
use App\Domains\Services\Order\Abstracts\IListOrderService;
use App\Support\Utils\Params\Search;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ListOrderService implements IListOrderService
{
    private IOrderRepository $orderRepository;

    public function __construct(IOrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function listOrderAll(Request $request): Collection
    {
        $search = new Search($request);
        $active = (bool) $request->active;
        return $this->orderRepository->readAll($search->getSearch(), $request->id, $active);
    }

    public function listOrderFind(Request $request): Collection
    {
        return $this->orderRepository->readOne($request->id, (bool)$request->active);
    }
}
