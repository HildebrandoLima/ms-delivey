<?php

namespace App\Services\Provider;

use App\Http\Requests\ProviderRequest;
use App\Jobs\EmailForRegisterJob;
use App\Models\Fornecedor;
use App\Repositories\CheckRegisterRepository;
use App\Repositories\ProviderRepository;
use App\Services\Provider\Interfaces\ICreateProviderService;
use App\Support\Utils\Enums\UserEnum;

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
        $this->checkRegisterRepository->checkProviderExist($request);
        $provider = $this->mapToModel($request);
        $providerId = $this->providerRepository->insert($provider);
        EmailForRegisterJob::dispatch($request->email);
        return $providerId;
    }

    private function mapToModel(ProviderRequest $request): Fornecedor
    {
        $provider = new Fornecedor();
        $provider->nome = $request->nome;
        $provider->cnpj = str_replace(array('.','-','/'), "", $request->cnpj);
        $provider->email = $request->email;
        $provider->data_fundacao = $request->dataFundacao;
        $provider->ativo = UserEnum::ATIVADO;
        return $provider;
    }
}
