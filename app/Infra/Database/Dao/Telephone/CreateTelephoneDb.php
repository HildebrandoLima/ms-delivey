<?php

namespace App\Infra\Database\Dao\Telephone;

use App\Http\Requests\Telephone\CreateTelephoneRequest;
use App\Infra\Database\Config\DbBase;

class CreateTelephoneDb extends DbBase
{
    public function createTelephone(CreateTelephoneRequest $request): bool
    {
        return $this->db
        ->table('telefone')
        ->insert([
            'ddd' => '123',
            'numero' => $request->numero,
            'tipo' => $request->tipo,
            'ddd_id' => $request->dddId,
            'usuario_id' => $request->usuarioId,
            'fornecedor_id' => $request->fornecedorId,
            'created_at' => new \DateTime()
        ]);
    }
}
