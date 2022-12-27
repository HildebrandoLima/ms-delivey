<?php

namespace App\Services\Provider;

use App\Http\Requests\Provider\EditProviderRequest;
use App\Infra\Database\Dao\Provider\EditProviderDb;
use App\Support\Utils\Enums\UserEnums;

class EditProviderService
{
    private EditProviderDb $editProviderDb;

    public function __construct(EditProviderDb $editProviderDb)
    {
        $this->editProviderDb = $editProviderDb;
    }

    public function editProvider(EditProviderRequest $request): bool
    {
        $atividade = $this->caseAtividade($request->atividade);
        return $this->editProviderDb->editProvider($request, $atividade);
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
