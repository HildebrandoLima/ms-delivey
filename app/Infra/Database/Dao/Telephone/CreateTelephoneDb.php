<?php

namespace App\Infra\Database\Dao\Telephone;

use App\Http\Requests\Telephone\CreateTelephoneRequest;
use App\Infra\Database\Config\DbBase;
use App\Support\Utils\Enums\TelephoneEnums;

class CreateTelephoneDb extends DbBase
{
    public function createTelephone(CreateTelephoneRequest $request): bool
    {
        return $this->db
        ->table('telefone')
        ->insert([
            'numero' => $request->numero,
            'tipo' => $request->tipo == 'Fixo' ? TelephoneEnums::TIPO_FIXO : TelephoneEnums::TIPO_CELULAR,
            'ddd_id' => $request->dddId,
            'usuario_id' => $request->usuarioId,
            'fornecedor_id' => $request->fornecedorId,
            'created_at' => new \DateTime()
        ]);
    }
}
