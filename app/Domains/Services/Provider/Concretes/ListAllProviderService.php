<?php

namespace App\Domains\Services\Provider\Concretes;

use App\Data\Repositories\Provider\Interfaces\IListAllProviderRepository;
use App\Domains\Dtos\ProviderDto;
use App\Domains\Services\Provider\Interfaces\IListAllProviderService;
use App\Domains\Traits\Dtos\ListPaginationMapper;
use App\Domains\Traits\RequestConfigurator;
use App\Support\Utils\Pagination\Interface\IPagination;
use App\Support\Utils\Params\Interface\ISearch;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ListAllProviderService implements IListAllProviderService
{
    use RequestConfigurator, ListPaginationMapper;

    private IListAllProviderRepository $listAllProviderRepository;
    private IPagination $pagination;
    private ISearch $search;
    private bool $active;

    public function __construct
    (
        IListAllProviderRepository $listAllProviderRepository,
        IPagination $pagination,
        ISearch $search
    )
    {
        $this->listAllProviderRepository = $listAllProviderRepository;
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
        $paginatedList = $this->listAllProviderRepository->hasPagination($this->search->getSearch(), $this->active);
        return $this->mapToDtoList($paginatedList, ProviderDto::class);
    }

    private function noPaginatedList(): Collection
    {
        $noPaginatedList = $this->listAllProviderRepository->noPagination($this->search->getSearch(), $this->active);
        return $this->mapToDtoList($noPaginatedList, ProviderDto::class);
    }
}
