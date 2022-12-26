<?php

namespace App\Infra\Database\Dao\Address;

use Illuminate\Http\Request;
use App\Infra\Database\Config\DbBase;

class DeleteAddressDb extends DbBase
{
    public function deleteAddress(Request $request): bool
    {
        return $this->db
        ->table('endereco')
        ->where('usuario_id', $request->usuarioId)
        ->delete();
    }
}
