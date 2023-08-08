<?php

namespace App\DataTransferObjects\MappersDtos;

use App\DataTransferObjects\Dtos\CategoryDto;

class CategoryMapperDto
{
    public static function mapper(array $category): CategoryDto
    {
        return new CategoryDto
        (
            $category['id'] ?? 0,
            $category['nome'] ?? '',
            $category['ativo'] ?? '',
            $category['created_at'] ?? '',
            $category['updated_at'] ?? '',
        );
    }
}
