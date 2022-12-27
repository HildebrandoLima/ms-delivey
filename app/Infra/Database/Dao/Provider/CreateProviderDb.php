<?php

namespace App\Infra\Database\Dao\Provider;

use App\Http\Requests\Provider\CreateProviderRequest;
use App\Infra\Database\Config\DbBase;

class CreateProviderDb extends DbBase
{
    public function createProvider(CreateProviderRequest $request, string $atividade): int
    {
        $fornecedorId = $this->db
        ->table('fornecedor')
        ->insertGetId([
            'nome' => $request->nome,
            'cnpj' => $request->cnpj,
            'email' => $request->email,
            'ativo' => $atividade,
            'data_fundacao' => $request->data_fundacao,
            'created_at' => new \DateTime()
        ]);
        return $fornecedorId;
    }
}
