<?php

namespace App\DataTransferObjects\MappersDtos;

use App\DataTransferObjects\Dtos\AddressDto;

class AddressMapperDto
{
    public static function mapper(array $address): AddressDto
    {
        return new AddressDto
        (
            $address['id'] ?? 0,
            $address['logradouro'] ?? '',
            $address['descricao'] ?? '',
            $address['bairro'] ?? '',
            $address['cidade'] ?? '',
            $address['cep'] ?? '',
            $address['uf'] ?? 0,
            $address['usuario_id'] ?? 0,
            $address['fornecedor_id'] ?? 0,
            $address['ativo'] ?? '',
            $address['created_at'] ?? '',
            $address['updated_at'] ?? '',
        );
    }
}
