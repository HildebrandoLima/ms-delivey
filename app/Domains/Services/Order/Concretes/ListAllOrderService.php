<?php

namespace App\Domains\Services\Order\Concretes;

use App\Data\Repositories\Order\Interfaces\IListAllOrderRepository;
use App\Domains\Services\Order\Interfaces\IListAllOrderService;
use App\Support\Utils\Params\Search;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ListAllOrderService implements IListAllOrderService
{
    private IListAllOrderRepository $listAllOrderRepository;

    public function __construct(IListAllOrderRepository $listAllOrderRepository)
    {
        $this->listAllOrderRepository = $listAllOrderRepository;
    }

    public function listAll(Request $request): Collection
    {
        $search = new Search($request);
        $active = (bool) $request->active;
        return $this->listAllOrderRepository->listAll($search->getSearch(), $request->id, $active);
    }
}
