<?php

namespace App\Support\Utils\CheckRegister;

use App\Exceptions\HttpBadRequest;
use App\Http\Requests\ProviderRequest;
use App\Models\Fornecedor;

class CheckProvider
{
    public function checkProviderExist(ProviderRequest $request): void
    {
        if (Fornecedor::query()
                ->where('nome', 'like', $request->nome)
                ->orWhere(function ($query) use ($request) {
                    $query->where('cnpj', '=', $request->cnpj)
                        ->orWhere(function ($query) use ($request) {
                            $query->where('email', 'like', $request->email);
                        });
                })
                ->count() != 0):
            throw new HttpBadRequest('O fornecedor informado já existe.');
        endif;
    }

    public function checkProviderIdExist(int $id): void
    {
        if (Fornecedor::query()->where('id', $id)->count() == 0):
            throw new HttpBadRequest('O fornecedor informado não existe.');
        endif;
    }
}
