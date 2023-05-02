<?php

namespace App\Infra\Database\Dao\Telephone;

use App\Http\Requests\TelephoneRequest;
use App\Infra\Database\Config\DbBase;
use App\Support\Utils\Enums\TelephoneEnums;

class CreateTelephoneDb extends DbBase
{
    public function createTelephone(TelephoneRequest $request): bool
    {
        foreach ($request->telefones as $telefone):
            $this->db
            ->table('telefone')
            ->insert([
                'numero' => $telefone['numero'],
                'tipo' => $telefone['tipo'] == 'Fixo' ? TelephoneEnums::TIPO_FIXO : TelephoneEnums::TIPO_CELULAR,
                'ddd_id' => $telefone['dddId'],
                'usuario_id' => $telefone['usuarioId'],
                'fornecedor_id' => $telefone['fornecedorId'],
                'created_at' => new \DateTime()
            ]);
        endforeach;
        return true;
    }
}
