<?php

namespace App\Services\Provider\Concretes;

use App\Http\Requests\Provider\EditProviderRequest;
use App\Models\Fornecedor;
use App\Repositories\Interfaces\ProviderRepositoryInterface;
use App\Services\Provider\Interfaces\EditProviderServiceInterface;
use App\Support\Enums\AtivoEnum;

class EditProviderService implements EditProviderServiceInterface
{
    private ProviderRepositoryInterface $providerRepository;

    public function __construct(ProviderRepositoryInterface $providerRepository)
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
        $provider->ativo = $request->ativo == true ? AtivoEnum::ATIVADO : AtivoEnum::DESATIVADO;
        return $provider;
    }
}
