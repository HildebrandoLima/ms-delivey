<?php

namespace App\Support\MapperEntity;

use App\Dtos\ImageDto;
use App\Support\AutoMapper\AutoMapper;
use Illuminate\Support\Facades\Storage;

class EntityProduct
{
    public static function images(array $imagens): array
    {
        foreach ($imagens as $key => $instance):
            $imagens[$key] = self::map($instance);
        endforeach;
        return $imagens;
    }

    private static function map(array $data): ImageDto
    {
        $image = AutoMapper::map($data, ImageDto::class);
        $image->caminho = Storage::disk('public')->url($data['caminho'])  ?? '';
        $image->produtoId = $data['produto_id'] ?? 0;
        return $image;
    }
}
