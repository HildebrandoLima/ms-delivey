<?php

namespace App\Services\Provider;

use App\Http\Requests\ProviderRequest;
use App\Models\Fornecedor;
use App\Repositories\ProviderRepository;
use App\Services\Provider\Interfaces\ICreateProviderService;
use App\Support\Utils\CheckRegister\CheckProvider;
use App\Support\Utils\Enums\UserEnums;
use DateTime;

class CreateProviderService implements ICreateProviderService
{
    private CheckProvider $checkProvider;
    private ProviderRepository $providerRepository;

    public function __construct
    (
        CheckProvider      $checkProvider,
        ProviderRepository $providerRepository
    )
    {
        $this->checkProvider      = $checkProvider;
        $this->providerRepository = $providerRepository;
    }

    public function createProvider(ProviderRequest $request): int
    {
        $this->request = $request;
        $provider = $this->mapToModel();
        $this->checkProvider->checkProviderExist($request);
        return $this->providerRepository->insert($provider);
    }

    private function mapToModel(): Fornecedor
    {
        $provider = new Fornecedor();
        $provider->nome = $this->request->nome;
        $provider->cnpj = $this->request->cnpj;
        $provider->email = $this->request->email;
        $provider->data_fundacao = $this->request->dataFundacao;
        $provider->ativo = UserEnums::ATIVADO;
        $provider->created_at = new DateTime();
        return $provider;
    }
}
