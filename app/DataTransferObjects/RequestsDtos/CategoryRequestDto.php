<?php

namespace App\DataTransferObjects\RequestsDtos;

use App\DataTransferObjects\Dtos\CategoryDto;
use App\Http\Requests\CategoryRequest;
use App\Support\Utils\Enums\CategoryEnum;

class CategoryRequestDto
{
    public static function fromRquest(CategoryRequest $request): CategoryDto
    {
        $categoryDto = new CategoryDto();
        $categoryDto->setNome($request['nome']);
        $categoryDto->setAtivo($request['ativo'] == 1 ? CategoryEnum::ATIVADO : CategoryEnum::DESATIVADO);
        return $categoryDto;
    }
}
