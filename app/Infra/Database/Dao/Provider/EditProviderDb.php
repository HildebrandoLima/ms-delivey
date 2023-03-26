<?php

namespace App\Infra\Database\Dao\Provider;

use App\Http\Requests\Provider\EditProviderRequest;
use App\Infra\Database\Config\DbBase;
use App\Support\Utils\Enums\UserEnums;

class EditProviderDb extends DbBase
{
    public function editProvider(EditProviderRequest $request): bool
    {
        return $this->db
        ->table('fornecedor')
        ->where('id', $request->fornecedorId)
        ->update([
            'nome' => $request->nome,
            'cnpj' => $request->cnpj,
            'email' => $request->email,
            'ativo' => $request->atividade === '1' ? UserEnums::ATIVADO : UserEnums::DESATIVADO,
            'updated_at' => new \DateTime()
        ]);
    }
}
