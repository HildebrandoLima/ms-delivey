<?php

namespace App\Domains\Services\Order\Concretes;

use App\Data\Repositories\Order\Interfaces\IListAllOrderRepository;
use App\Domains\Services\Order\Abstracts\IListOrderService;
use App\Support\Utils\Params\Search;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ListOrderService implements IListOrderService
{
    private IListAllOrderRepository $listAllOrderRepository;

    public function __construct(IListAllOrderRepository $listAllOrderRepository)
    {
        $this->listAllOrderRepository = $listAllOrderRepository;
    }

    public function listOrderAll(Request $request): Collection
    {
        $search = new Search($request);
        $active = (bool) $request->active;
        return $this->listAllOrderRepository->listAll($search->getSearch(), $request->id, $active);
    }

    public function listOrderFind(Request $request): Collection
    {
        return collect();
        //$this->orderRepository->readOne($request->id, (bool)$request->active);
    }
}
