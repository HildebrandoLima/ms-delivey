<?php

namespace App\DataTransferObjects\MappersDtos;

use App\DataTransferObjects\Dtos\ProviderDto;

class ProviderMapperDto
{
    public static function mapper(array $provider): ProviderDto
    {
        return new ProviderDto
        (
            $provider['id'] ?? 0,
            $provider['razao_social'] ?? '',
            $provider['cnpj'] ?? '',
            $provider['email'] ?? '',
            $provider['data_fundacao'] ?? '',
            $provider['endereco'] ?? [],
            $provider['telefone'] ?? [],
            $provider['ativo'] ?? 0,
            $provider['created_at'] ?? '',
            $provider['updated_at'] ?? '',
        );
    }
}
