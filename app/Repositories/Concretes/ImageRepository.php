<?php

namespace App\Repositories\Concretes;

use App\DataTransferObjects\Dtos\ImageDto;
use App\Models\Imagem;
use App\Repositories\Interfaces\ImageRepositoryInterface;

class ImageRepository implements ImageRepositoryInterface
{
    public function enableDisable(int $id, int $active): bool
    {
        return Imagem::query()->where('produto_id', '=', $id)->update(['ativo' => $active]);
    }

    public function create(ImageDto $imageDto): bool
    {
        Imagem::query()->create((array)$imageDto);
        return true;
    }
}
