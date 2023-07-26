<?php

namespace App\Services\Provider\Concretes;

use App\Http\Requests\Provider\ProviderRequest;
use App\Jobs\EmailForRegisterJob;
use App\Models\Fornecedor;
use App\Repositories\Interfaces\ProviderRepositoryInterface;
use App\Services\Provider\Interfaces\CreateProviderServiceInterface;
use App\Support\Permissions\ValidationPermission;
use App\Support\Enums\PermissionEnum;
use App\Support\Enums\ProviderEnum;

class CreateProviderService extends ValidationPermission implements CreateProviderServiceInterface
{
    private ProviderRepositoryInterface $providerRepository;

    public function __construct(ProviderRepositoryInterface $providerRepository)
    {
        $this->providerRepository = $providerRepository;
    }

    public function createProvider(ProviderRequest $request): int
    {
        $this->validationPermission(PermissionEnum::CRIAR_FORNECEDOR);
        $provider = $this->map($request);
        $providerId = $this->providerRepository->create($provider);
        if ($providerId) $this->dispatchJob($providerId, $request->email);
        return $providerId;
    }

    private function map(ProviderRequest $request): Fornecedor
    {
        $provider = new Fornecedor();
        $provider->razao_social = $request->razaoSocial;
        $provider->cnpj = str_replace(array('.','-','/'), "", $request->cnpj);
        $provider->email = $request->email;
        $provider->data_fundacao = $request->dataFundacao;
        $provider->ativo = ProviderEnum::ATIVADO;
        return $provider;
    }

    private function dispatchJob(int $providerId, string $email): void
    {
        EmailForRegisterJob::dispatch($email, $providerId);
    }
}
