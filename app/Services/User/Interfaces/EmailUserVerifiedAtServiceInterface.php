<?php

namespace App\Services\User\Interfaces;

interface EmailUserVerifiedAtServiceInterface
{
    public function emailVerifiedAt(int $id, int $active): bool;
}
