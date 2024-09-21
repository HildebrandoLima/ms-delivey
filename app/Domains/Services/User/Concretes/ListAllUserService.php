<?php

namespace App\Domains\Services\User\Concretes;

use App\Data\Repositories\User\Interfaces\IListAllUserRepository;
use App\Domains\Services\User\Interfaces\IListAllUserService;
use App\Support\Utils\Pagination\Pagination;
use App\Support\Utils\Params\Search;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ListAllUserService implements IListAllUserService
{
    private IListAllUserRepository $listAllUserRepository;

    public function __construct(IListAllUserRepository $listAllUserRepository)
    {
        $this->listAllUserRepository = $listAllUserRepository;
    }

    public function listAll(Request $request): Collection
    {
        $pagination = new Pagination($request);
        $search = new Search($request);
        $active = (bool) $request->active;

        if ($pagination->hasPagination($pagination)) {
            return $this->listAllUserRepository->hasPagination($search->getSearch(), $active);
        } else {
            return $this->listAllUserRepository->noPagination($search->getSearch(), $active);
        }
    }
}
