<?php

namespace App\Domains\Services\Provider\Concretes;

use App\Data\Repositories\Provider\Interfaces\IListFindByIdProviderRepository;
use App\Domains\Services\Provider\Interfaces\IListFindByIdProviderService;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ListFindByIdProviderService implements IListFindByIdProviderService
{
    private IListFindByIdProviderRepository $listFindByIdProviderRepository;

    public function __construct(IListFindByIdProviderRepository $listFindByIdProviderRepository)
    {
        $this->listFindByIdProviderRepository = $listFindByIdProviderRepository;
    }

    public function listFindById(Request $request): Collection
    {
        return $this->listFindByIdProviderRepository->listFindById($request->id, (bool)$request->active);
    }
}
