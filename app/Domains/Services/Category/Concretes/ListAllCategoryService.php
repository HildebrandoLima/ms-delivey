<?php

namespace App\Domains\Services\Category\Concretes;

use App\Data\Repositories\Category\Interfaces\IListAllCategoryRepository;
use App\Domains\Dtos\CategoryDto;
use App\Domains\Services\Category\Interfaces\IListAllCategoryService;
use App\Domains\Traits\Dtos\ListPaginationMapper;
use App\Domains\Traits\RequestConfigurator;
use App\Support\Utils\Pagination\Interface\IPagination;
use App\Support\Utils\Params\Interface\ISearch;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ListAllCategoryService implements IListAllCategoryService
{
    use RequestConfigurator, ListPaginationMapper;
    private IListAllCategoryRepository $listAllCategoryRepository;
    private IPagination $pagination;
    private ISearch $search;
    private bool $active;

    public function __construct
    (
        IListAllCategoryRepository $listAllCategoryRepository,
        IPagination $pagination,
        ISearch $search
    )
    {
        $this->listAllCategoryRepository = $listAllCategoryRepository;
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
        $paginatedList = $this->listAllCategoryRepository->hasPagination($this->search->getSearch(), $this->active);
        return $this->mapToDtoList($paginatedList, CategoryDto::class);
    }

    private function noPaginatedList(): Collection
    {
        $noPaginatedList = $this->listAllCategoryRepository->noPagination($this->search->getSearch(), $this->active);
        return $this->mapToDtoList($noPaginatedList, CategoryDto::class);
    }
}
