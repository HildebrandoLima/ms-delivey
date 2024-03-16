<?php

namespace App\Domains\Services\Provider\Concretes;

use App\Data\Repositories\Abstracts\IEntityRepository;
use App\Domains\Services\Provider\Abstracts\ICreateProviderService;
use App\Http\Requests\Provider\CreateProviderRequest;
use App\Jobs\EmailForRegisterJob;
use App\Models\Fornecedor;
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
        if ($providerId) $this->dispatchJob($request->email, $providerId);
        return $providerId;
    }

    public function map(CreateProviderRequest $request): Fornecedor
    {
        $provider = new Fornecedor();
        $provider->razao_social = $request->razaoSocial;
        $provider->cnpj = $request->cnpj;
        $provider->email = $request->email;
        $provider->data_fundacao = $request->dataFundacao;
        $provider->ativo = AtivoEnum::ATIVADO;
        return $provider;
    }

    private function dispatchJob(string $email, int $providerId): void
    {
        EmailForRegisterJob::dispatch($email, $providerId);
    }
}
