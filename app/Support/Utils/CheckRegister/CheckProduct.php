<?php

namespace App\Support\Utils\CheckRegister;

use App\Exceptions\HttpBadRequest;
use App\Http\Requests\ProductRequest;
use App\Models\Produto;

class CheckProduct
{
    public function checkProductExist(ProductRequest $request): void
    {
        if (Produto::query()->where('nome', 'like', $request->nome)
                ->orWhere('codigo_barra', '=', $request->codigoBarra)
                ->count() != 0):
            throw new HttpBadRequest('O produto informado já existe.');
        endif;
    }

    public function checkProductIdExist(int $id): void
    {
        if (Produto::query()->where('id', $id)->count() == 0):
            throw new HttpBadRequest('O produto informado não existe.');
        endif;
    }
}
