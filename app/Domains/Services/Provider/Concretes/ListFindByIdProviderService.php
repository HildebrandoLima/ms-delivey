<?php

namespace App\Domains\Services\Provider\Concretes;

use App\Data\Repositories\Provider\Interfaces\IListFindByIdProviderRepository;
use App\Domains\Dtos\ProviderDto;
use App\Domains\Services\Provider\Interfaces\IListFindByIdProviderService;
use App\Domains\Traits\Dtos\ListPaginationMapper;
use App\Domains\Traits\RequestConfigurator;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ListFindByIdProviderService implements IListFindByIdProviderService
{
    use RequestConfigurator, ListPaginationMapper;

    private IListFindByIdProviderRepository $listFindByIdProviderRepository;

    public function __construct(IListFindByIdProviderRepository $listFindByIdProviderRepository)
    {
        $this->listFindByIdProviderRepository = $listFindByIdProviderRepository;
    }

    public function listFindById(Request $request): Collection
    {
        $this->setRequest($request);
        return $this->listCollection();
    }

    private function listCollection(): Collection
    {
        $listCollection = $this->listFindByIdProviderRepository->listFindById($this->request->id, $this->request->active);
        return $this->mapToDtoList($listCollection, ProviderDto::class);
    }
}
