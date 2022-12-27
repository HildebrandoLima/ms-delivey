<?php

namespace App\Infra\Database\Dao\Provider;

use App\Http\Requests\Provider\EditProviderRequest;
use App\Infra\Database\Config\DbBase;

class EditProviderDb extends DbBase
{
    public function editProvider(EditProviderRequest $request, string $atividade): bool
    {
        return $this->db
        ->table('fornecedor')
        ->where('id', $request->fornecedorId)
        ->update([
            'nome' => $request->nome,
            'cnpj' => $request->cnpj,
            'email' => $request->email,
            'ativo' => $atividade,
            'updated_at' => new \DateTime()
        ]);
    }
}
