<?php

namespace App\DataTransferObjects\RequestsDtos;

use App\DataTransferObjects\Dtos\ImageDto;
use App\Support\Utils\Enums\ImageEnum;

class ImageRequestDto
{
    public static function fromRquest(string $path, int $productId): ImageDto
    {
        $imageDto = new ImageDto();
        $imageDto->setCaminho($path);
        $imageDto->setProdutoId($productId);
        $imageDto->setAtivo(ImageEnum::ATIVADO);
        return $imageDto;
    }
}
