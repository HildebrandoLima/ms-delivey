<?php

namespace App\Infra\Database\Dao\Address;

use App\Http\Requests\Address\EditAddressRequest;
use App\Infra\Database\Config\DbBase;

class EditAddressDb extends DbBase
{
    public function editAddress(EditAddressRequest $request, string $logradouro): bool
    {
        return $this->db
        ->table('endereco')
        ->where('id', $request->enderecoId)
        ->update([
            'logradouro' => $logradouro,
            'descricao' => $request->descricao,
            'bairro' => $request->bairro,
            'cidade' => $request->cidade,
            'cep' => $request->cep,
            'uf_id' => $request->ufId,
            'updated_at' => new \DateTime()
        ]);
    }
}
