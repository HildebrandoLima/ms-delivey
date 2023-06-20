<?php

namespace App\Services\User;

use App\Repositories\CheckRegisterRepository;
use App\Repositories\EntityRepositoryInterface;
use App\Services\User\Interfaces\IEmailUserVerifiedAtService;

class EmailUserUserVerifiedAtService implements IEmailUserVerifiedAtService
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

    public function emailVerifiedAt(int $id, int $active): bool
    {
        $this->checkRegisterRepository->checkUserIdExist($id);
        return $this->entityRepositoryInterface->emailVerifiedAt($id, $active);
    }
}
