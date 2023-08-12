<?php

namespace App\Services\Provider\Concretes;

use App\Http\Requests\Provider\CreateProviderRequest;
use App\Jobs\EmailForRegisterJob;
use App\Models\Fornecedor;
use App\Repositories\Abstracts\IEntityRepository;
use App\Services\Provider\Abstracts\ICreateProviderService;
use App\Support\Enums\AtivoEnum;

class CreateProviderService implements ICreateProviderService
{
    private IEntityRepository $providerRepository;

    public function __construct(IEntityRepository $providerRepository)
    {
        $this->providerRepository = $providerRepository;
    }

    public function createProvider(CreateProviderRequest $request): int
    {
        $provider = $this->map($request);
        $providerId = $this->providerRepository->create($provider);
        if ($providerId) $this->dispatchJob($providerId, $request->email);
        return $providerId;
    }

    private function map(CreateProviderRequest $request): Fornecedor
    {
        $provider = new Fornecedor();
        $provider->razao_social = $request->razaoSocial;
        $provider->cnpj = $request->cnpj;
        $provider->email = $request->email;
        $provider->data_fundacao = $request->dataFundacao;
        $provider->ativo = AtivoEnum::ATIVADO;
        return $provider;
    }

    private function dispatchJob(int $providerId, string $email): void
    {
        EmailForRegisterJob::dispatch($email, $providerId);
    }
}
