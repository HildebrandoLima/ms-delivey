<?php

namespace App\Repositories\Abstracts;

use Illuminate\Support\Collection;

interface IUserRepository
{
    public function readAll(string $search, bool $filter): Collection;
    public function readOne(int $id, bool $filter): Collection;
    public function read(string $codigo): int;
    public function delete(string $codigo): bool;
}
