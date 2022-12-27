<?php

namespace App\Services\Telephone;

use App\Http\Requests\Telephone\CreateTelephoneRequest;
use App\Infra\Database\Dao\Telephone\CreateTelephoneDb;
use App\Support\Utils\Enums\TelephoneEnums;

class CreateTelephoneService
{
    private CreateTelephoneDb $createTelephoneDb;

    public function __construct(CreateTelephoneDb $createTelephoneDb)
    {
        $this->createTelephoneDb = $createTelephoneDb;
    }

    public function createTelephone(CreateTelephoneRequest $request): int
    {
        $tipo = $this->caseTipo($request->tipo);
        return $this->createTelephoneDb->createTelephone($request, $tipo);
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
