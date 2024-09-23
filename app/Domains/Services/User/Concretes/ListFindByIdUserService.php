<?php

namespace App\Domains\Services\User\Concretes;

use App\Data\Repositories\User\Interfaces\IListFindByIdUserRepository;
use App\Domains\Dtos\UserDto;
use App\Domains\Services\User\Interfaces\IListFindByIdUserService;
use App\Domains\Traits\Dtos\ListPaginationMapper;
use App\Domains\Traits\RequestConfigurator;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ListFindByIdUserService implements IListFindByIdUserService
{    
    use RequestConfigurator, ListPaginationMapper;

    private IListFindByIdUserRepository $listFindByIdUserRepository;

    public function __construct(IListFindByIdUserRepository $listFindByIdUserRepository)
    {
        $this->listFindByIdUserRepository = $listFindByIdUserRepository;
    }

    public function listFindById(Request $request): Collection
    {
        $this->setRequest($request);
        return $this->listCollection();
    }

    private function listCollection(): Collection
    {
        $listCollection = $this->listFindByIdUserRepository->listFindById($this->request->id, $this->request->active);
        return $this->mapToDtoList($listCollection, UserDto::class);
    }
}
