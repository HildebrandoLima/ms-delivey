<?php

namespace App\Domains\Services\User\Concretes;

use App\Data\Repositories\Abstracts\IEntityRepository;
use App\Domains\Services\User\Abstracts\IEmailUserVerifiedAtService;
use App\Models\User;
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
