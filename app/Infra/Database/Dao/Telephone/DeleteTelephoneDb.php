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
        ->where('id', $request->telefoneId)
        ->orWhere('usuario_id', $request->usuarioId)
        ->orWhere('fornecedor_id', $request->fornecedorId)
        ->delete();
    }
}
