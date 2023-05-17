<?php

namespace App\Support\Utils\CheckRegister;

use App\Exceptions\HttpBadRequest;
use App\Models\Telefone;

class CheckTelephone
{
    public function checkTelephoneExist(string $numero): void
    {
        if (Telefone::query()
                ->where('numero', 'like', $numero)
                ->count() != 0):
            throw new HttpBadRequest('O número informado já existe: ', (int)$numero);
        endif;
    }

    public function checkTelephoneIdExist(int $id): void
    {
        if (Telefone::query()->where('id', $id)->count() == 0):
            throw new HttpBadRequest('O número informado não existe.');
        endif;
    }
}
