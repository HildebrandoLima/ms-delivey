<?php

namespace App\Domains\Services\User\Abstracts;

interface IEmailUserVerifiedAtService
{
    public function emailVerifiedAt(int $id): bool;
}
