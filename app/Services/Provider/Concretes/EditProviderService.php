<?php

namespace App\Services\Provider\Concretes;

use App\Http\Requests\ProviderRequest;
use App\Models\Fornecedor;
use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Repositories\Interfaces\ProviderRepositoryInterface;
use App\Services\Provider\Interfaces\EditProviderServiceInterface;
use App\Support\Permissions\ValidationPermission;
use App\Support\Utils\Enums\PermissionEnum;
use App\Support\Utils\Enums\ProviderEnum;

class EditProviderService extends ValidationPermission implements EditProviderServiceInterface
{
    private CheckEntityRepositoryInterface $checkEntityRepository;
    private ProviderRepositoryInterface    $providerRepository;

    public function __construct
    (
        CheckEntityRepositoryInterface $checkEntityRepository,
        ProviderRepositoryInterface    $providerRepository,
    )
    {
        $this->checkEntityRepository = $checkEntityRepository;
        $this->providerRepository    = $providerRepository;
    }

    public function editProvider(int $id, ProviderRequest $request): bool
    {
        $this->validationPermission(PermissionEnum::EDITAR_FORNECEDOR);
        $this->checkEntityRepository->checkProviderIdExist($id);
        $provider = $this->map($request);
        return $this->providerRepository->update($id, $provider);
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
}
