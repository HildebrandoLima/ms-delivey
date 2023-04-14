<?php

namespace App\Services\Provider;

use App\Exceptions\HttpBadRequest;
use App\Http\Requests\Provider\CreateProviderRequest;
use App\Infra\Database\Dao\Provider\CreateProviderDb;
use App\Models\Fornecedor;

class CreateProviderService
{
    private CreateProviderDb $createProviderDb;

    public function __construct(CreateProviderDb $createProviderDb)
    {
        $this->createProviderDb = $createProviderDb;
    }

    public function createProvider(CreateProviderRequest $request): int
    {
        $this->checkProvider($request);
        return $this->createProviderDb->createProvider($request);
    }

    private function checkProvider($request): void
    {
        if (Fornecedor::query()->where('nome', $request->nome)->orWhere('cnpj', $request->cnpj)
            ->orWhere('email', $request->email)->count() !== 0):
            throw new HttpBadRequest('O fornecedor já existe');
        endif;
    }
}
