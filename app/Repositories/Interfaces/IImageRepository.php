<?php

namespace App\Repositories\Interfaces;

use App\Models\Imagem;
use App\Support\Utils\Pagination\Pagination;
use Illuminate\Support\Collection;

interface IImageRepository {
    public function insert(Imagem $imagem): bool;
    public function update(int $id, Imagem $imagem): bool;
    public function delete(int $id): bool;
    public function getAll(int $id): Collection;
}
