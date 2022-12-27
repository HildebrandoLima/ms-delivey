<?php

namespace App\Services\Provider;

use App\Http\Requests\Provider\CreateProviderRequest;
use App\Infra\Database\Dao\Provider\CreateProviderDb;
use App\Support\Utils\Enums\UserEnums;

class CreateProviderService
{
    private CreateProviderDb $createProviderDb;

    public function __construct(CreateProviderDb $createProviderDb)
    {
        $this->createProviderDb = $createProviderDb;
    }

    public function createProvider(CreateProviderRequest $request): int
    {
        $atividade = $this->caseAtividade($request->atividade);
        return $this->createProviderDb->createProvider($request, $atividade);
    }

    private function caseAtividade($atividade): string
    {
        switch ($atividade):
            case $atividade === '0':
                return UserEnums::DESATIVADO;
            case $atividade === '1':
                return UserEnums::ATIVADO;
        endswitch;
    }
}
