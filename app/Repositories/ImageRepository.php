<?php

namespace App\Repositories;

use App\Models\Imagem;
use App\Repositories\Interfaces\IImageRepository;
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

    public function getAll(int $id): Collection
    {
        return Imagem::query()->select(['caminho as path', 'produto_id as produtoId'])->where('produto_id', $id)->get();
    }
}
