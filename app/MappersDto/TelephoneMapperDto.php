<?php

namespace App\MappersDto;

use App\DataTransferObjects\List\TelephoneDto;

class TelephoneMapperDto
{
    public static function map(array $telephone): TelephoneDto
    {
        $telephoneDto = new TelephoneDto
        (
            $telephone['id'] ?? 0,
            $telephone['numero'] ?? '',
            $telephone['tipo'] ?? '',
            $telephone['ddd_id'] ?? 0,
            $telephone['usuario_id'] ?? 0,
            $telephone['fornecedor_id'] ?? 0,
            $telephone['ativo'] ?? 0,
            $telephone['created_at'] ?? '',
            $telephone['updated_at'] ?? '',
        );
        return $telephoneDto;
    }
}
