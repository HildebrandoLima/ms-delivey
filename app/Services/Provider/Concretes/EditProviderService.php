<?php

namespace App\Services\Provider\Concretes;

use App\Http\Requests\Provider\EditProviderRequest;
use App\Models\Fornecedor;
use App\Repositories\Abstracts\IEntityRepository;
use App\Services\Provider\Abstracts\IEditProviderService;

class EditProviderService implements IEditProviderService
{
    private IEntityRepository $providerRepository;

    public function __construct(IEntityRepository $providerRepository)
    {
        $this->providerRepository = $providerRepository;
    }

    public function editProvider(EditProviderRequest $request): bool
    {
        $provider = $this->map($request);
        return $this->providerRepository->update($provider);
    }

    private function map(EditProviderRequest $request): Fornecedor
    {
        $provider = new Fornecedor();
        $provider->id = $request->id;
        $provider->razao_social = $request->razaoSocial;
        $provider->cnpj = $request->cnpj;
        $provider->email = $request->email;
        return $provider;
    }
}
