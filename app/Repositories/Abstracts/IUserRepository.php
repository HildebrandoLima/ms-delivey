<?php

namespace App\Repositories\Abstracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface IUserRepository
{
    public function readAll(string $search, bool $filter): Collection;
    public function readOne(int $id, bool $filter): Collection;
    public function readCode(string $codigo): int;
    public function readSocial(string $email): Model|null;
    public function delete(string $codigo): bool;
}
