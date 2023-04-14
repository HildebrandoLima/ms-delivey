<?php

namespace App\Infra\Database\Dao\Telephone;

use App\Http\Requests\Telephone\EditTelephoneRequest;
use App\Infra\Database\Config\DbBase;
use App\Support\Utils\Enums\TelephoneEnums;

class EditTelephoneDb extends DbBase
{
    public function editTelephone(EditTelephoneRequest $request): bool
    {
        return $this->db
        ->table('telefone')
        ->where('id', $request->telefoneId)
        ->update([
            'numero' => $request->numero,
            'tipo' => $request->tipo == 'Fixo' ? TelephoneEnums::TIPO_FIXO : TelephoneEnums::TIPO_CELULAR,
            'ddd_id' => $request->dddId,
            'updated_at' => new \DateTime()
        ]);
    }
}
