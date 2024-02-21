<?php

namespace App\Services\User\Concretes;

use App\Models\User;
use App\Repositories\Abstracts\IEntityRepository;
use App\Services\User\Abstracts\IEmailUserVerifiedAtService;
use App\Support\Enums\AtivoEnum;

class EmailUserVerifiedAtService implements IEmailUserVerifiedAtService
{
    private IEntityRepository $userRepository;

    public function __construct(IEntityRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function emailVerifiedAt(int $id): bool
    {
        $user = $this->map($id);
        return $this->userRepository->update($user);
    }

    public function map(int $id): User
    {
        $user = new User();
        $user->id = $id;
        $user->email_verificado = AtivoEnum::ATIVADO;
        return $user;
    }
}
