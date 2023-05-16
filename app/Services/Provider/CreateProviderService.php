<?php

namespace App\Services\Provider;

use App\Exceptions\HttpBadRequest;
use App\Http\Requests\ProviderRequest;
use App\Models\Fornecedor;
use App\Repositories\ProviderRepository;
use App\Services\Provider\Interfaces\ICreateProviderService;
use App\Support\Utils\Enums\UserEnums;
use DateTime;

class CreateProviderService implements ICreateProviderService
{
    private ProviderRepository $providerRepository;

    public function __construct(ProviderRepository $providerRepository)
    {
        $this->providerRepository = $providerRepository;
    }

    public function createProvider(ProviderRequest $request): int
    {
        $this->request = $request;
        $provider = $this->mapToModel();
        $this->checkProvider();
        return $this->providerRepository->insert($provider);
    }

    private function checkProvider(): void
    {
        if (!Fornecedor::query()
                ->where('nome', 'like', $this->request->nome)
                ->orWhere(function ($query) {
                    $query->where('cnpj', '=', $this->request->cnpj)
                        ->orWhere(function ($query) {
                            $query->where('email', 'like', $this->request->email);
                        });
                })
                ->count() == 0):
            throw new HttpBadRequest('O fornecedor já existe');
        endif;
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
