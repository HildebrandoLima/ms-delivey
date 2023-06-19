<?php

namespace App\MappersDto;

use App\DataTransferObjects\List\AddressDto;

class AddressMapperDto
{
    public static function map(array $address): AddressDto
    {
        $addressDto = new AddressDto
        (
            $address['id'] ?? 0,
            $address['logradouro'] ?? '',
            $address['descricao'] ?? '',
            $address['bairro'] ?? '',
            $address['cidade'] ?? '',
            $address['cep'] ?? '',
            $address['uf_id'] ?? 0,
            $address['usuario_id'] ?? 0,
            $address['fornecedor_id'] ?? 0,
            $address['ativo'] ?? 0,
            $address['created_at'] ?? '',
            $address['updated_at'] ?? '',
        );
        return $addressDto;
    }
}
