<?php

namespace App\Services\Provider\Concretes;

use App\Http\Requests\Provider\EditProviderRequest;
use App\Models\Fornecedor;
use App\Repositories\Interfaces\ProviderRepositoryInterface;
use App\Services\Provider\Interfaces\EditProviderServiceInterface;
use App\Support\Permissions\ValidationPermission;
use App\Support\Enums\PermissionEnum;
use App\Support\Enums\ProviderEnum;

class EditProviderService extends ValidationPermission implements EditProviderServiceInterface
{
    private ProviderRepositoryInterface $providerRepository;

    public function __construct(ProviderRepositoryInterface $providerRepository)
    {
        $this->providerRepository = $providerRepository;
    }

    public function editProvider(EditProviderRequest $request): bool
    {
        $this->validationPermission(PermissionEnum::EDITAR_FORNECEDOR);
        $provider = $this->map($request);
        return $this->providerRepository->update($provider);
    }

    private function map(EditProviderRequest $request): Fornecedor
    {
        $provider = new Fornecedor();
        $provider->id = $request->id;
        $provider->razao_social = $request->razaoSocial;
        $provider->cnpj = str_replace(array('.','-','/'), "", $request->cnpj);
        $provider->email = $request->email;
        $provider->ativo = ProviderEnum::ATIVADO;
        return $provider;
    }
}
