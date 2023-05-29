<?php

namespace App\Services\User;

use App\Repositories\CheckRegisterRepository;
use App\Repositories\UserRepository;
use App\Services\User\Interfaces\IListUserService;
use App\Support\Utils\Pagination\Pagination;
use App\Support\Utils\Parameters\FilterByActive;
use Illuminate\Support\Collection;

class ListUserService implements IListUserService
{
    private CheckRegisterRepository $checkRegisterRepository;
    private UserRepository          $userRepository;

    public function __construct
    (
        CheckRegisterRepository $checkRegisterRepository,
        UserRepository          $userRepository
    )
    {
        $this->checkRegisterRepository = $checkRegisterRepository;
        $this->userRepository          = $userRepository;
    }

    public function listUserAll(Pagination $pagination, int $active): Collection
    {
        return $this->userRepository->getAll($pagination, $active);
    }

    public function listUserFind(int $id, string $search, int $active): Collection
    {
        if ($id != 0):
            $this->checkRegisterRepository->checkUserIdExist($id);
        endif;
        return $this->userRepository->getFind($id, $search, $active);
    }
}
