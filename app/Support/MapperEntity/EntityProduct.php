<?php

namespace App\Support\MapperEntity;

use App\Dtos\ImageDto;
use App\Support\Utils\DateFormat\DateFormat;
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
        $image = new ImageDto();
        $image->caminho = Storage::disk('public')->url($data['caminho'])  ?? '';
        $image->produtoId = $data['produto_id'] ?? 0;
        $image->ativo = $data['ativo'] ?? '';
        $image->criadoEm = DateFormat::dateFormat($data['created_at'] ?? '') ?? '';
        $image->alteradoEm = DateFormat::dateFormat($data['updated_at'] ?? '') ?? '';
        return $image;
    }
}
