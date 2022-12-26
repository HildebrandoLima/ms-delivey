<?php

namespace App\Infra\Database\Dao\Telephone;

use Illuminate\Http\Request;
use App\Infra\Database\Config\DbBase;

class DeleteTelephoneDb extends DbBase
{
    public function deleteTelephone(Request $request): bool
    {
        return $this->db
        ->table('telefone')
        ->where('usuario_id', $request->usuarioId)
        ->delete();
    }
}
