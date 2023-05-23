<?php

namespace App\Support\Utils\MapToModel;

use App\Http\Requests\ProviderRequest;
use App\Models\Fornecedor;
use App\Support\Utils\Enums\UserEnums;

class ProviderModel {
    public function providerModel(ProviderRequest $request): Fornecedor
    {
        $provider = new Fornecedor();
        $provider->nome = $request->nome;
        $provider->cnpj = $request->cnpj;
        $provider->email = $request->email;
        $provider->data_fundacao = $request->dataFundacao;
        $request->ativo == 1 ? $provider->ativo = UserEnums::ATIVADO : $provider->ativo = UserEnums::DESATIVADO;
        return $provider;
    }
}
