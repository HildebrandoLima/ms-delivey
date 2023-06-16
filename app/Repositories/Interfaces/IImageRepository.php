<?php

namespace App\Repositories\Interfaces;

use App\Models\Imagem;
use App\Support\Utils\Pagination\Pagination;
use Illuminate\Support\Collection;

interface IImageRepository {
    public function create(Imagem $imagem): bool;
    public function update(int $id, Imagem $imagem): bool;
    public function delete(int $id): bool;
    public function enableDisable(int $id, int $active): bool;
    public function getAll(int $id, int $active): Collection;
}
