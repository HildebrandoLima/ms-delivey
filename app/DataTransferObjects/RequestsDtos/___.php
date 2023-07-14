<?php

namespace App\DataTransferObjects\RequestsDtos;

use App\DataTransferObjects\Dtos\ProviderDto;
use App\Http\Requests\ProviderRequest;
use App\Support\Utils\Enums\ProviderEnum;

class ProviderRequestDto
{
    public static function fromRquest(ProviderRequest $request): ProviderDto
    {
        $providerDto = new ProviderDto();
        $providerDto->setRazaoSocial($request['razaoSocial']);
        $providerDto->setCnpj(str_replace(array('.','-','/'), "", $request['cnpj']));
        $providerDto->setEmail($request['email']);
        $providerDto->setDataFundacao($request['dataFundacao']);
        $providerDto->setAtivo($request['ativo'] == true ? ProviderEnum::ATIVADO : ProviderEnum::DESATIVADO);
        return $providerDto;
    }
}
