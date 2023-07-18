<?php

namespace App\Repositories\Concretes;

use App\Models\Imagem;
use App\Repositories\Interfaces\ImageRepositoryInterface;

class ImageRepository implements ImageRepositoryInterface
{
    public function enableDisable(int $id, int $active): bool
    {
        return Imagem::query()->where('produto_id', '=', $id)->update(['ativo' => $active]);
    }

    public function create(Imagem $imagem): bool
    {
        Imagem::query()->create($imagem->toArray());
        return true;
    }
}
