<?php

namespace App\Domains\Traits\Dtos;

use App\Domains\Dtos\ImageDto;
use Illuminate\Support\Facades\Storage;

trait EntityProduct
{
    use AutoMapper;

    public function images(array $images): array
    {
        foreach ($images as $key => $value) {
            $images[$key] = $this->map($value);
        }
        return $images;
    }

    private function map(array $data): ImageDto
    {
        $image = $this->mapTo($data, ImageDto::class);
        $image->caminho = Storage::disk('public')->url($data['caminho']) ?? '';
        $image->produtoId = $data['produto_id'] ?? 0;
        return $image;
    }
}
