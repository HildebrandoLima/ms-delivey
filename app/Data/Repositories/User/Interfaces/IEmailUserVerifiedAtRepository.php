<?php

namespace App\Data\Repositories\User\Interfaces;

interface IEmailUserVerifiedAtRepository
{
    public function emailVerifiedAt(int $id): bool;
}
