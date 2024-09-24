<?php

namespace App\Domains\Services\Product\Concretes;

use App\Data\Repositories\Product\Interfaces\IListAllProductRepository;
use App\Domains\Dtos\ProductDto;
use App\Domains\Services\Product\Interfaces\IListAllProductService;
use App\Domains\Traits\Dtos\ListPaginationMapper;
use App\Domains\Traits\RequestConfigurator;
use App\Support\Utils\Pagination\Interface\IPagination;
use App\Support\Utils\Params\Interface\ISearch;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ListAllProductService implements IListAllProductService
{
    use RequestConfigurator, ListPaginationMapper;

    private IListAllProductRepository $listAllProductRepository;
    private IPagination $pagination;
    private ISearch $search;
    private bool $active;

    public function __construct
    (
        IListAllProductRepository $listAllProductRepository,
        IPagination $pagination,
        ISearch $search
    )
    {
        $this->listAllProductRepository = $listAllProductRepository;
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
        $paginatedList = $this->listAllProductRepository->hasPagination($this->search->getSearch(), $this->active);
        return $this->mapToDtoList($paginatedList, ProductDto::class);
    }

    private function noPaginatedList(): Collection
    {
        $noPaginatedList = $this->listAllProductRepository->noPagination($this->search->getSearch(), $this->active);
        return $this->mapToDtoList($noPaginatedList, ProductDto::class);
    }
}
