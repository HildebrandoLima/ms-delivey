<?php

namespace App\Domains\Services\Order\Concretes;

use App\Data\Repositories\Order\Concretes\ListFindByIdOrderRepository;
use App\Domains\Dtos\OrderDto;
use App\Domains\Services\Order\Interfaces\IListFindByIdOrderService;
use App\Domains\Traits\Dtos\ListPaginationMapper;
use App\Domains\Traits\RequestConfigurator;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ListFindByIdOrderService implements IListFindByIdOrderService
{
    use RequestConfigurator, ListPaginationMapper;

    private ListFindByIdOrderRepository $listFindByIdOrderRepository;

    public function __construct(ListFindByIdOrderRepository $listFindByIdOrderRepository)
    {
        $this->listFindByIdOrderRepository = $listFindByIdOrderRepository;
    }

    public function listFindById(Request $request): Collection
    {
        $this->setRequest($request);
        return $this->listCollection();
    }

    private function listCollection(): Collection
    {
        $listCollection = $this->listFindByIdOrderRepository->listFindById($this->request->id, $this->request->active);
        return $this->mapToDtoList($listCollection, OrderDto::class);
    }
}
