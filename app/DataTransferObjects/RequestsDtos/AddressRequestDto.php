<?php

namespace App\DataTransferObjects\RequestsDtos;

use App\DataTransferObjects\Dtos\AddressDto;
use App\Http\Requests\AddressRequest;

class AddressRequestDto
{
    public static function fromRquest(AddressRequest $request): AddressDto
    {
        $addressDto = new AddressDto();
        $addressDto->setLogradouro($request['logradouro']);
        $addressDto->setDescricao($request['descricao']);
        $addressDto->setBairro($request['bairro']);
        $addressDto->setCidade($request['cidade']);
        $addressDto->setCep($request['cep']);
        $addressDto->setUfId($request['ufId']);
        $addressDto->setUsuarioId($request['usuarioId'] ?? null);
        $addressDto->setFornecedorId($request['fornecedorId'] ?? null);
        $addressDto->setAtivo($request['ativo']);
        return $addressDto;
    }
}
