<?php

namespace App\Services\Provider\Concretes;

use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Repositories\Interfaces\ProviderRepositoryInterface;
use App\Services\Provider\Interfaces\ListProviderServiceInterface;
use App\Support\Permissions\ValidationPermission;
use App\Support\Enums\PermissionEnum;
use Illuminate\Support\Collection;

class ListProviderService extends ValidationPermission implements ListProviderServiceInterface
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

    public function listProviderAll(int $active): Collection
    {
        $this->validationPermission(PermissionEnum::LISTAR_FORNECEDOR);
        return $this->providerRepository->getAll($active);
    }

    public function listProviderFind(int $id, string $search, int $active): Collection
    {
        $this->validationPermission(PermissionEnum::LISTAR_FORNECEDOR);
        if ($id != 0) $this->checkEntityRepository->checkProviderIdExist($id);
        return $this->providerRepository->getOne($id, $search, $active);
    }
}
