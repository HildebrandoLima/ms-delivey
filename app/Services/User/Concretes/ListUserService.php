<?php

namespace App\Services\User\Concretes;

use App\Repositories\Abstracts\IUserRepository;
use App\Services\User\Abstracts\IListUserService;
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
        return $this->userRepository->readAll($pagination, $search, $filter);
    }

    public function listUserFind(int $id, bool $filter): Collection
    {
        return $this->userRepository->readOne($id, $filter);
    }
}
