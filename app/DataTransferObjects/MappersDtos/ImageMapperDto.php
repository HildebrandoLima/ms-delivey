<?php

namespace App\DataTransferObjects\MappersDtos;

use App\DataTransferObjects\Dtos\ImageDto;

class ImageMapperDto
{
    public static function mapper(array $image): ImageDto
    {
        return ImageDto::construction()
        ->setCaminho($image['caminho'] ?? '')
        ->setProdutoId($image['produto_id'] ?? 0)
        ->setAtivo($image['ativo'] ?? '')
        ->setCriadoEm($image['created_at'] ?? '')
        ->setAlteradoEm($image['updated_at'] ?? '');
    }
}
