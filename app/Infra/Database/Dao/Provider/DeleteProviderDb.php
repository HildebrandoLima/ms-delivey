<?php

namespace App\Infra\Database\Dao\Provider;

use App\Http\Requests\Provider\ProviderRequest;
use App\Infra\Database\Config\DbBase;

class DeleteProviderDb extends DbBase
{
    public function deleteProvider(ProviderRequest $request): bool
    {
        return $this->db
        ->table('fornecedor')
        ->where('id', $request->fornecedorId)
        ->delete();
    }
}
