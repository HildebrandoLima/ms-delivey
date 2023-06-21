<?php

namespace App\DataTransferObjects\RequestsDtos;

use App\DataTransferObjects\Dtos\ProviderDto;
use App\Http\Requests\ProviderRequest;

class ProviderRequestDto
{
    public static function fromRquest(ProviderRequest $request): ProviderDto
    {
        $providerDto = new ProviderDto();
        $providerDto->setRazaoSocial($request['razaoSocial']);
        $providerDto->setCnpj(str_replace(array('.','-','/'), "", $request['cnpj']));
        $providerDto->setEmail($request['email']);
        $providerDto->setDataFundacao($request['dataFundacao']);
        $providerDto->setAtivo($request['ativo']);
        return $providerDto;
    }
}
