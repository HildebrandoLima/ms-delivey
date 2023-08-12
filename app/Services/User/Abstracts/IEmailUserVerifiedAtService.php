<?php

namespace App\Services\User\Abstracts;

interface IEmailUserVerifiedAtService
{
    public function emailVerifiedAt(int $id): bool;
}
