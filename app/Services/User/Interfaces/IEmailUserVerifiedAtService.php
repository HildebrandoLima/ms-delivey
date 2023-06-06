<?php

namespace App\Services\User\Interfaces;

interface IEmailUserVerifiedAtService
{
    public function emailVerifiedAt(int $id, int $active): bool;
}
