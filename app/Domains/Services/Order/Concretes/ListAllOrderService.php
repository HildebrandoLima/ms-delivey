<?php

namespace App\Domains\Services\Order\Concretes;

use App\Data\Repositories\Order\Interfaces\IListAllOrderRepository;
use App\Domains\Dtos\OrderDto;
use App\Domains\Services\Order\Interfaces\IListAllOrderService;
use App\Domains\Traits\Dtos\ListPaginationMapper;
use App\Domains\Traits\RequestConfigurator;
use App\Support\Utils\Pagination\Interface\IPagination;
use App\Support\Utils\Params\Interface\ISearch;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ListAllOrderService implements IListAllOrderService
{
    use RequestConfigurator, ListPaginationMapper;

    private IListAllOrderRepository $listAllOrderRepository;
    private IPagination $pagination;
    private ISearch $search;
    private bool $active;

    public function __construct
    (
        IListAllOrderRepository $listAllOrderRepository,
        IPagination $pagination,
        ISearch $search
    )
    {
        $this->listAllOrderRepository = $listAllOrderRepository;
        $this->pagination = $pagination;
        $this->search = $search;
    }

    public function listAll(Request $request): Collection
    {
        $this->setParams($request, $this->pagination, $this->search);
        $this->active = (bool) $request->active;
        return $this->pagination->hasPagination() ? $this->paginatedList() : $this->noPaginatedList();
    }

    private function paginatedList(): Collection
    {
        $paginatedList = $this->listAllOrderRepository->hasPagination($this->search->getSearch(), $this->active);
        return $this->mapToDtoList($paginatedList, OrderDto::class);
    }

    private function noPaginatedList(): Collection
    {
        $noPaginatedList = $this->listAllOrderRepository->noPagination($this->search->getSearch(), $this->active);
        return $this->mapToDtoList($noPaginatedList, OrderDto::class);
    }
}
