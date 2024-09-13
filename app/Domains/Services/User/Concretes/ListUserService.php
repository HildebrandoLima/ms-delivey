<?php

namespace App\Domains\Services\User\Concretes;

use App\Data\Repositories\Abstracts\IUserRepository;
use App\Domains\Services\User\Abstracts\IListUserService;
use App\Support\Utils\Pagination\Pagination;
use Illuminate\Support\Collection;

class ListUserService implements IListUserService
{
    private IUserRepository $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function listUserAll(Pagination $pagination, string $search, bool $filter): Collection
    {
        if ($pagination->hasPagination($pagination)):
            return $this->userRepository->hasPagination($search, $filter);
        else:
            return $this->userRepository->noPagination($search, $filter);
        endif;
    }

    public function listUserFind(int $id, bool $filter): Collection
    {
        return $this->userRepository->readOne($id, $filter);
    }
}
