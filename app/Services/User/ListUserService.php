<?php

namespace App\Services\User;

use App\Repositories\CheckRegisterRepository;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\User\Interfaces\IListUserService;
use Illuminate\Support\Collection;

class ListUserService implements IListUserService
{
    private CheckRegisterRepository $checkRegisterRepository;
    private UserRepositoryInterface $userRepositoryInterface;

    public function __construct
    (
        CheckRegisterRepository $checkRegisterRepository,
        UserRepositoryInterface $userRepositoryInterface,
    )
    {
        $this->checkRegisterRepository = $checkRegisterRepository;
        $this->userRepositoryInterface = $userRepositoryInterface;
    }

    public function listUserAll(int $active): Collection
    {
        return $this->userRepositoryInterface->getAll($active);
    }

    public function listUserFind(int $id, string $search, int $active): Collection
    {
        if ($id != 0) $this->checkRegisterRepository->checkUserIdExist($id);
        return $this->userRepositoryInterface->getOne($id, $search, $active);
    }
}
