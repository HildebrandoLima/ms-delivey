<?php

namespace App\Infra\Database\Dao\Telephone;

use App\Http\Requests\Telephone\EditTelephoneRequest;
use App\Infra\Database\Config\DbBase;

class EditTelephoneDb extends DbBase
{
    public function editTelephone(EditTelephoneRequest $request): bool
    {
        return $this->db
        ->table('telefone')
        ->where('id', $request->telefoneId)
        ->update([
            'ddd' => '123',
            'numero' => $request->numero,
            'tipo' => $request->tipo,
            'ddd_id' => $request->dddId,
            'updated_at' => new \DateTime()
        ]);
    }
}
