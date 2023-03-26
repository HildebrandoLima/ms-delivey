<?php

namespace App\Infra\Database\Dao\Address;

use App\Http\Requests\Address\EditAddressRequest;
use App\Infra\Database\Config\DbBase;
use App\Support\Utils\Enums\AddressEnums;

class EditAddressDb extends DbBase
{
    public function editAddress(EditAddressRequest $request): bool
    {
        return $this->db
        ->table('endereco')
        ->where('id', $request->enderecoId)
        ->update([
            'logradouro' => $request->logradouro === 'Rua' ? AddressEnums::LOGRADOURO_RUA : AddressEnums::LOGRADOURO_AVENIDA,
            'descricao' => $request->descricao,
            'bairro' => $request->bairro,
            'cidade' => $request->cidade,
            'cep' => $request->cep,
            'uf_id' => $request->ufId,
            'updated_at' => new \DateTime()
        ]);
    }
}
