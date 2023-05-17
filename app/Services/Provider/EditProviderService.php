<?php

namespace App\Services\Provider;

use App\Http\Requests\ProviderRequest;
use App\Models\Fornecedor;
use App\Repositories\ProviderRepository;
use App\Services\Provider\Interfaces\IEditProviderService;
use App\Support\Utils\CheckRegister\CheckProvider;
use App\Support\Utils\Enums\UserEnums;
use DateTime;

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
        $provider = $this->mapToModel();
        return $this->providerRepository->update($id, $provider);
    }

    private function mapToModel(): Fornecedor
    {
        $provider = new Fornecedor();
        $provider->nome = $this->request->nome;
        $provider->cnpj = $this->request->cnpj;
        $provider->email = $this->request->email;
        $provider->data_fundacao = $this->request->dataFundacao;
        $provider->ativo = UserEnums::ATIVADO;
        $provider->updated_at = new DateTime();
        return $provider;
    }
}
