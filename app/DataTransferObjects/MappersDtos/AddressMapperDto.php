<?php

namespace App\DataTransferObjects\MappersDtos;

use App\DataTransferObjects\Dtos\AddressDto;

class AddressMapperDto
{
    public static function mapper(array $address): AddressDto
    {
        return AddressDto::construction()
        ->setEnderecoId($address['id'] ?? 0)
        ->setLogradouro($address['logradouro'] ?? '')
        ->setDescricao($address['descricao'] ?? '')
        ->setBairro($address['bairro'] ?? '')
        ->setCidade($address['cidade'] ?? '')
        ->setCep($address['cep'] ?? '')
        ->setUfId($address['uf_id'] ?? 0)
        ->setUsuarioId($address['usuario_id'] ?? 0)
        ->setFornecedorId($address['fornecedor_id'] ?? 0)
        ->setAtivo($address['ativo'] ?? '')
        ->setCriadoEm($address['created_at'] ?? '')
        ->setAlteradoEm($address['updated_at'] ?? '');
    }
}
