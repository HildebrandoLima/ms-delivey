<?php

namespace App\DataTransferObjects\MappersDtos;

use App\DataTransferObjects\Dtos\CategoryDto;

class CategoryMapperDto
{
    public static function mapper(array $category): CategoryDto
    {
        return CategoryDto::construction()
        ->setCategoriaId($category['id'] ?? 0)
        ->setNome($category['nome'] ?? '')
        ->setAtivo($category['ativo'] ?? '')
        ->setCriadoEm($category['created_at'] ?? '')
        ->setAlteradoEm($category['updated_at'] ?? '');
    }
}
