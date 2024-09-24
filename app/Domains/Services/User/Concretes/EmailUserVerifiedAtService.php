<?php

namespace App\Domains\Services\User\Concretes;

use App\Data\Repositories\User\Interfaces\IEmailUserVerifiedAtRepository;
use App\Domains\Services\User\Interfaces\IEmailUserVerifiedAtService;

class EmailUserVerifiedAtService implements IEmailUserVerifiedAtService
{
    private IEmailUserVerifiedAtRepository $emailUserVerifiedAtRepository;

    public function __construct(IEmailUserVerifiedAtRepository $emailUserVerifiedAtRepository)
    {
        $this->emailUserVerifiedAtRepository = $emailUserVerifiedAtRepository;
    }

    public function emailVerifiedAt(int $id): bool
    {
        return $this->emailUserVerifiedAtRepository->emailVerifiedAt($id);
    }
}
