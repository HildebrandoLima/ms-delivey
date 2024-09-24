<?php

namespace App\Data\Repositories\Auth\Interfaces;

interface IRefreshPasswordRepository
{
    public function update(int $userId, string $senha): bool;
}
