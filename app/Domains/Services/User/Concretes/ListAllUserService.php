<?php

namespace App\Domains\Services\User\Concretes;

use App\Data\Repositories\User\Interfaces\IListAllUserRepository;
use App\Domains\Dtos\UserDto;
use App\Domains\Services\User\Interfaces\IListAllUserService;
use App\Domains\Traits\Dtos\ListPaginationMapper;
use App\Domains\Traits\RequestConfigurator;
use App\Support\Utils\Pagination\Interface\IPagination;
use App\Support\Utils\Params\Interface\ISearch;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ListAllUserService implements IListAllUserService
{
    use RequestConfigurator, ListPaginationMapper;

    private IListAllUserRepository $listAllUserRepository;
    private IPagination $pagination;
    private ISearch $search;
    private bool $active;

    public function __construct
    (
        IListAllUserRepository $listAllUserRepository,
        IPagination $pagination,
        ISearch $search
    )
    {
        $this->listAllUserRepository = $listAllUserRepository;
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
        $paginatedList = $this->listAllUserRepository->hasPagination($this->search->getSearch(), $this->active);
        return $this->mapToDtoList($paginatedList, UserDto::class);
    }

    private function noPaginatedList(): Collection
    {
        $noPaginatedList = $this->listAllUserRepository->noPagination($this->search->getSearch(), $this->active);
        return $this->mapToDtoList($noPaginatedList, UserDto::class);
    }
}
