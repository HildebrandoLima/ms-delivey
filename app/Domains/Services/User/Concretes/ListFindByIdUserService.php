<?php

namespace App\Domains\Services\User\Concretes;

use App\Data\Repositories\User\Interfaces\IListFindByIdUserRepository;
use App\Domains\Services\User\Interfaces\IListFindByIdUserService;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ListFindByIdUserService implements IListFindByIdUserService
{
    private IListFindByIdUserRepository $listFindByIdUserRepository;

    public function __construct(IListFindByIdUserRepository $listFindByIdUserRepository)
    {
        $this->listFindByIdUserRepository = $listFindByIdUserRepository;
    }

    public function listFindById(Request $request): Collection
    {
        return $this->listFindByIdUserRepository->listFindById($request->id, (bool)$request->active);
    }
}
