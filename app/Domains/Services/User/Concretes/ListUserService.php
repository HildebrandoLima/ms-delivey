<?php

namespace App\Domains\Services\User\Concretes;

use App\Data\Repositories\Abstracts\IUserRepository;
use App\Domains\Services\User\Abstracts\IListUserService;
use App\Support\Utils\Pagination\Pagination;
use App\Support\Utils\Params\Search;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ListUserService implements IListUserService
{
    private IUserRepository $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function listUserAll(Request $request): Collection
    {
        $pagination = new Pagination($request);
        $search = new Search($request);
        $active = (bool) $request->active;
        if ($pagination->hasPagination($pagination)) {
            return $this->userRepository->hasPagination($search->getSearch(), $active);
        } else {
            return $this->userRepository->noPagination($search->getSearch(), $active);
        }
    }

    public function listUserFind(Request $request): Collection
    {
        return $this->userRepository->readOne($request->id, (bool)$request->active);
    }
}
