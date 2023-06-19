<?php

namespace App\Services\User;

use App\Repositories\CheckRegisterRepository;
use App\Repositories\EntityRepositoryInterface;
use App\Services\User\Interfaces\IListUserService;
use Illuminate\Support\Collection;

class ListUserService implements IListUserService
{
    private CheckRegisterRepository   $checkRegisterRepository;
    private EntityRepositoryInterface $entityRepositoryInterface;

    public function __construct
    (
        CheckRegisterRepository   $checkRegisterRepository,
        EntityRepositoryInterface $entityRepositoryInterface,
    )
    {
        $this->checkRegisterRepository   = $checkRegisterRepository;
        $this->entityRepositoryInterface = $entityRepositoryInterface;
    }

    public function listUserAll(int $active): Collection
    {
        return $this->entityRepositoryInterface->getAll($active);
    }

    public function listUserFind(int $id, string $search, int $active): Collection
    {
        if ($id != 0) $this->checkRegisterRepository->checkUserIdExist($id);
        return $this->entityRepositoryInterface->getOne($id, $search, $active);
    }
}
