<?php

namespace App\Support\MapperEntity;

use App\DataTransferObjects\MappersDtos\ImageMapperDto;

class EntityProduct
{
    public static function imagens(array $imagens): array
    {
        foreach ($imagens as $key => $instance):
            $imagens[$key] = ImageMapperDto::mapper($instance);
        endforeach;
        return $imagens;
    }
}
