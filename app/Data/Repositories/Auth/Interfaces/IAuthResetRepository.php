<?php

namespace App\Data\Repositories\Auth\Interfaces;

interface IAuthResetRepository
{
    public function readCode(string $codigo): int;
    public function delete(string $codigo): bool;
}
