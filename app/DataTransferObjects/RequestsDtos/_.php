<?php

namespace App\DataTransferObjects\RequestsDtos;

use App\DataTransferObjects\Dtos\AddressDto;
use App\Http\Requests\AddressRequest;
use App\Support\Utils\Cases\AddressCase;
use App\Support\Utils\Enums\AddressEnum;

class AddressRequestDto
{
    public static function fromRquest(AddressRequest $request): AddressDto
    {
        $addressDto = new AddressDto();
        $logradouro = new AddressCase();
        $addressDto->setLogradouro($logradouro->publicPlaceCase($request['logradouro']));
        $addressDto->setDescricao($request['descricao']);
        $addressDto->setBairro($request['bairro']);
        $addressDto->setCidade($request['cidade']);
        $addressDto->setCep(str_replace('-', "", $request['cep']));
        $addressDto->setUfId($request['ufId']);
        $addressDto->setUsuarioId($request['usuarioId'] ?? null);
        $addressDto->setFornecedorId($request['fornecedorId'] ?? null);
        $addressDto->setAtivo($request['ativo'] == true ? AddressEnum::ATIVADO : AddressEnum::DESATIVADO);
        return $addressDto;
    }
}
