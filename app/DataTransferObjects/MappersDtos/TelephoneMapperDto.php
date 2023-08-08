<?php

namespace App\DataTransferObjects\MappersDtos;

use App\DataTransferObjects\Dtos\TelephoneDto;

class TelephoneMapperDto
{
    public static function mapper(array $telephone): TelephoneDto
    {
        return new TelephoneDto
        (
            $telephone['id'] ?? 0,
            $telephone['numero'] ?? '',
            $telephone['tipo'] ?? '',
            $telephone['usuario_id'] ?? 0,
            $telephone['fornecedor_id'] ?? 0,
            $telephone['ativo'] ?? '',
            $telephone['created_at'] ?? '',
            $telephone['updated_at'] ?? '',
        );
    }
}
