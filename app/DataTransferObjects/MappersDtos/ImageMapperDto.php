<?php

namespace App\DataTransferObjects\MappersDtos;

use App\DataTransferObjects\Dtos\ImageDto;

class ImageMapperDto
{
    public static function mapper(array $image): ImageDto
    {
        return new ImageDto
        (
            $image['caminho'] ?? '',
            $image['produto_id'] ?? 0,
            $image['ativo'] ?? '',
            $image['created_at'] ?? '',
            $image['updated_at'] ?? '',
        );
    }
}
