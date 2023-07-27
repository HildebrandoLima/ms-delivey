<?php

namespace App\Services\Provider\Concretes;

use App\Repositories\Interfaces\ProviderRepositoryInterface;
use App\Services\Provider\Interfaces\ListProviderServiceInterface;
use App\Support\Permissions\ValidationPermission;
use App\Support\Enums\PermissionEnum;
use Illuminate\Support\Collection;

class ListProviderService extends ValidationPermission implements ListProviderServiceInterface
{
    private ProviderRepositoryInterface $providerRepository;

    public function __construct(ProviderRepositoryInterface $providerRepository)
    {
        $this->providerRepository = $providerRepository;
    }

    public function listProviderAll(string $search, bool $active): Collection
    {
        $this->validationPermission(PermissionEnum::LISTAR_FORNECEDORES);
        return $this->providerRepository->getAll($search, $active);
    }

    public function listProviderFind(int $id, bool $active): Collection
    {
        $this->validationPermission(PermissionEnum::LISTAR_DETALHES_FORNECEDOR);
        return $this->providerRepository->getOne($id, $active);
    }
}
