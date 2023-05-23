<?php

namespace App\Services\Provider;

use App\Http\Requests\ProviderRequest;
use App\Models\Fornecedor;
use App\Repositories\ProviderRepository;
use App\Services\Provider\Interfaces\IEditProviderService;
use App\Support\Utils\CheckRegister\CheckProvider;
use App\Support\Utils\Enums\UserEnums;

class EditProviderService implements IEditProviderService
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

    public function editProvider(int $id, ProviderRequest $request): bool
    {
        $this->request = $request;
        $this->checkProvider->checkProviderIdExist($id);
        $provider = $this->mapToModel($request);
        return $this->providerRepository->update($id, $provider);
    }

    private function mapToModel(ProviderRequest $request): Fornecedor
    {
        $provider = new Fornecedor();
        $provider->nome = $request->nome;
        $provider->cnpj = $request->cnpj;
        $provider->email = $request->email;
        $provider->data_fundacao = $request->dataFundacao;
        $request->ativo == 1 ? $provider->ativo = UserEnums::ATIVADO : $provider->ativo = UserEnums::DESATIVADO;
        return $provider;
    }
}
