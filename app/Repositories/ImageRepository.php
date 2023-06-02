<?php

namespace App\Repositories;

use App\Models\Imagem;
use App\Repositories\Interfaces\IImageRepository;
use Illuminate\Support\Collection;

class ImageRepository implements IImageRepository {
    public function insert(Imagem $imagem): bool
    {
        Imagem::query()->create($imagem->toArray());
        return true;
    }

    public function update(int $id, Imagem $imagem): bool
    {
        return true;
    }

    public function delete(int $id): bool
    {
        return Imagem::query()->where('id', $id)->delete();
    }

    public function getAll(int $id, int $active): Collection
    {
        return Imagem::query()->select([
            'id as imagemId',
            'caminho as path',
            'produto_id as produtoId',
            'ativo as ativo'
        ])->where('ativo', $active)->where('produto_id', $id)->get();
    }
}
