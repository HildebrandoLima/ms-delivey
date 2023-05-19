<?php

namespace App\Support\Utils\CheckRegister;

use App\Exceptions\HttpBadRequest;
use App\Models\Endereco;

class CheckAddress
{
    public function checkAddressIdExist(int $id): void
    {
        if (Endereco::query()->where('id', $id)->count() == 0):
            throw new HttpBadRequest('O código do endereço informado não existe.');
        endif;
    }
}
