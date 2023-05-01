<?php

namespace App\Infra\Database\Dao\Address;

use App\Http\Requests\AddressRequest;
use App\Infra\Database\Config\DbBase;
use App\Support\Utils\Enums\AddressEnums;

class CreateAddressDb extends DbBase
{
    public function createAddress(AddressRequest $request): bool
    {
        return $this->db
        ->table('endereco')
        ->insert([
            'logradouro' => $request->logradouro == 'Rua' ? AddressEnums::LOGRADOURO_RUA : AddressEnums::LOGRADOURO_AVENIDA,
            'descricao' => $request->descricao,
            'bairro' => $request->bairro,
            'cidade' => $request->cidade,
            'cep' => $request->cep,
            'uf_id' => $request->ufId,
            'usuario_id' => isset($request->usuarioId) ? $request->usuarioId : 0,
            'fornecedor_id' => isset($request->fornecedorId) ? $request->fornecedorId : 0,
            'created_at' => new \DateTime()
        ]);
    }
}
