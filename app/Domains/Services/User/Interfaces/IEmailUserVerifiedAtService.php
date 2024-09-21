<?php

namespace App\Domains\Services\User\Interfaces;

interface IEmailUserVerifiedAtService
{
    public function emailVerifiedAt(int $id): bool;
}
