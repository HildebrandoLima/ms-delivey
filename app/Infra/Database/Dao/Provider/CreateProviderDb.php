<?php

namespace App\Infra\Database\Dao\Provider;

use App\Http\Requests\Provider\CreateProviderRequest;
use App\Infra\Database\Config\DbBase;
use App\Support\Utils\Enums\UserEnums;

class CreateProviderDb extends DbBase
{
    public function createProvider(CreateProviderRequest $request): int
    {
        $fornecedorId = $this->db
        ->table('fornecedor')
        ->insertGetId([
            'nome' => $request->nome,
            'cnpj' => $request->cnpj,
            'email' => $request->email,
            'ativo' => UserEnums::ATIVADO,
            'data_fundacao' => $request->dataFundacao,
            'created_at' => new \DateTime()
        ]);
        return $fornecedorId;
    }
}
