<?php

namespace App\DataTransferObjects\RequestsDtos;

use App\DataTransferObjects\Dtos\CategoryDto;
use App\Http\Requests\CategoryRequest;

class CategoryRequestDto
{
    public static function fromRquest(CategoryRequest $request): CategoryDto
    {
        $categoryDto = new CategoryDto();
        $categoryDto->setNome($request['nome']);
        $categoryDto->setAtivo($request['ativo']);
        return $categoryDto;
    }
}
