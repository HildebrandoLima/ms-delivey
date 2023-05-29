<?php

namespace App\Repositories\Interfaces;

use App\Models\Fornecedor;
use App\Support\Utils\Pagination\Pagination;
use Illuminate\Support\Collection;

interface IProviderRepository {
    public function insert(Fornecedor $fornecedor): int;
    public function update(int $id, Fornecedor $fornecedor): bool;
    public function delete(int $id): bool;
    public function getAll(Pagination $pagination, int $active): Collection;
    public function getFind(int $id, string $search, int $active): Collection;
}
