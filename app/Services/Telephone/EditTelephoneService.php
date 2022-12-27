<?php

namespace App\Services\Telephone;

use App\Http\Requests\Telephone\EditTelephoneRequest;
use App\Infra\Database\Dao\Telephone\EditTelephoneDb;
use App\Support\Utils\Enums\TelephoneEnums;

class EditTelephoneService
{
    private EditTelephoneDb $editTelephoneDb;

    public function __construct(EditTelephoneDb $editTelephoneDb)
    {
        $this->editTelephoneDb = $editTelephoneDb;
    }

    public function editTelephone(EditTelephoneRequest $request): bool
    {
        $tipo = $this->caseTipo($request->tipo);
        return $this->editTelephoneDb->editTelephone($request, $tipo);
    }

    private function caseTipo($tipo): string
    {
        switch ($tipo):
            case $tipo === 'Fixo':
                return TelephoneEnums::TIPO_FIXO;
            case $tipo === 'Celular':
                return TelephoneEnums::TIPO_CELULAR;
        endswitch;
    }
}
