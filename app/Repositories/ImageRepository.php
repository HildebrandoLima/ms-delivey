<?php

namespace App\Repositories;

use App\Models\Imagem;
use App\Repositories\Interfaces\IImageRepository;
use App\Support\Utils\Pagination\Pagination;
use Illuminate\Support\Collection;

class ImageRepository implements IImageRepository {
    public function insert(Imagem $imagem): bool
    {
        return Imagem::query()->insert($imagem->toArray());
    }

    public function update(int $id, Imagem $imagem): bool
    {
        return true;
    }

    public function delete(int $id): bool
    {
        return true;
    }

    public function getAll(Pagination $pagination, string $search): Collection
    {
        return collect();
    }

    public function getFind(int $id): Collection
    {
        return collect();
    }
}
