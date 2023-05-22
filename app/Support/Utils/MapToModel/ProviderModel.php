<?php

namespace App\Support\Utils\MapToModel;

use App\Http\Requests\ProviderRequest;
use App\Models\Fornecedor;
use App\Support\Utils\Enums\UserEnums;
use DateTime;

class ProviderModel {
    public function providerModel(ProviderRequest $request, string $method): Fornecedor
    {
        $provider = new Fornecedor();
        $provider->nome = $request->nome;
        $provider->cnpj = $request->cnpj;
        $provider->email = $request->email;
        $provider->data_fundacao = $request->dataFundacao;
        $request->ativo == 1 ? $provider->ativo = UserEnums::ATIVADO : $provider->ativo = UserEnums::DESATIVADO;
        $method == 'create' ? $provider->created_at = new DateTime() : $provider->updated_at = new DateTime();
        return $provider;
    }
}
