<?php

namespace App\Services\Provider;

use App\Http\Requests\ProviderRequest;
use App\Models\Fornecedor;
use App\Repositories\CheckRegisterRepository;
use App\Repositories\ProviderRepository;
use App\Services\Provider\Interfaces\IEditProviderService;
use App\Support\Utils\Enums\ProviderEnum;

class EditProviderService implements IEditProviderService
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

    public function editProvider(int $id, ProviderRequest $request): bool
    {
        $this->request = $request;
        $this->checkRegisterRepository->checkProviderIdExist($id);
        $provider = $this->mapToModel($request);
        return $this->providerRepository->update($id, $provider);
    }

    private function mapToModel(ProviderRequest $request): Fornecedor
    {
        $provider = new Fornecedor();
        $provider->nome = $request->nome;
        $provider->cnpj = str_replace(array('.','-','/'), "", $request->cnpj);
        $provider->email = $request->email;
        $provider->data_fundacao = $request->dataFundacao;
        $request->ativo == 1 ? $provider->ativo = ProviderEnum::ATIVADO : $provider->ativo = ProviderEnum::DESATIVADO;
        return $provider;
    }
}
