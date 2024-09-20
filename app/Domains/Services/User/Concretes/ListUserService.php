<?php

namespace App\Domains\Services\User\Concretes;

use App\Data\Repositories\User\Interfaces\IListAllUserRepository;
use App\Domains\Services\User\Abstracts\IListUserService;
use App\Support\Utils\Pagination\Pagination;
use App\Support\Utils\Params\Search;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ListUserService implements IListUserService
{
    private IListAllUserRepository $listAllUserRepository;

    public function __construct(IListAllUserRepository $listAllUserRepository)
    {
        $this->listAllUserRepository = $listAllUserRepository;
    }

    public function listUserAll(Request $request): Collection
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

    public function listUserFind(Request $request): Collection
    {
        return collect();
        //$this->userRepository->readOne($request->id, (bool)$request->active);
    }
}
