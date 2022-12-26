<?php

namespace App\Infra\Database\Dao\Address;

use App\Http\Requests\Address\CreateAddressRequest;
use App\Infra\Database\Config\DbBase;

class CreateAddressDb extends DbBase
{
    public function createAddress(CreateAddressRequest $request): bool
    {
        return $this->db
        ->table('endereco')
        ->insert([
            'logradouro' => $request->logradouro,
            'descricao' => $request->descricao,
            'bairro' => $request->bairro,
            'cidade' => $request->cidade,
            'cep' => $request->cep,
            'uf_id' => $request->ufId,
            'usuario_id' => $request->usuarioId,
            'fornecedor_id' => $request->fornecedorId,
            'created_at' => new \DateTime()
        ]);
    }
}
