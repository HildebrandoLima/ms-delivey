<?php

namespace App\Services\Provider;

use App\Http\Requests\ProviderRequest;
use App\Jobs\EmailForRegisterJob;
use App\Models\Fornecedor;
use App\Repositories\CheckRegisterRepository;
use App\Repositories\ProviderRepository;
use App\Services\Provider\Interfaces\ICreateProviderService;
use App\Support\Utils\Enums\ProviderEnum;

class CreateProviderService implements ICreateProviderService
{
    private CheckRegisterRepository $checkRegisterRepository;
    private ProviderRepository $providerRepository;

    public function __construct
    (
        CheckRegisterRepository $checkRegisterRepository,
        ProviderRepository      $providerRepository
    )
    {
        $this->checkRegisterRepository = $checkRegisterRepository;
        $this->providerRepository      = $providerRepository;
    }

    public function createProvider(ProviderRequest $request): int
    {
        $this->request = $request;
        $this->checkExist();
        $provider = $this->mapToModel();
        $providerId = $this->providerRepository->create($provider);
        if ($providerId) $this->dispatchJob();
        return $providerId;
    }

    public function checkExist(): void
    {
        $this->checkRegisterRepository->checkProviderExist($this->request);
    }

    private function mapToModel(): Fornecedor
    {
        $provider = new Fornecedor();
        $provider->razao_social = $this->request->razaoSocial;
        $provider->cnpj = str_replace(array('.','-','/'), "", $this->request->cnpj);
        $provider->email = $this->request->email;
        $provider->data_fundacao = $this->request->dataFundacao;
        $provider->ativo = ProviderEnum::ATIVADO;
        return $provider;
    }

    public function dispatchJob(): void
    {
        EmailForRegisterJob::dispatch($this->request->email);
    }
}
