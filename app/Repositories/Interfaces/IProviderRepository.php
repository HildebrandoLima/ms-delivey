<?php

namespace App\Repositories\Interfaces;

use App\Models\Fornecedor;
use Illuminate\Support\Collection;

interface IProviderRepository {
    public function create(Fornecedor $fornecedor): Fornecedor;
    public function emailVerifiedAt(int $id, int $active): bool;
    public function update(int $id, Fornecedor $fornecedor): bool;
    public function delete(int $id): bool;
    public function enableDisable(int $id, int $active): bool;
    public function getAll(int $active): Collection;
    public function getFind(int $id, string $search, int $active): Collection;
}
