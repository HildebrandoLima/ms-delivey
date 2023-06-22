<?php

namespace App\Services\Provider\Concretes;

use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Repositories\Interfaces\ProviderRepositoryInterface;
use App\Services\Provider\Interfaces\ListProviderServiceInterface;
use Illuminate\Support\Collection;

class ListProviderService implements ListProviderServiceInterface
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
        return $this->providerRepository->getAll($active);
    }

    public function listProviderFind(int $id, string $search, int $activ): Collection
    {
        if ($id != 0) $this->checkEntityRepository->checkProviderIdExist($id);
        return $this->providerRepository->getOne($id, $search, $activ);
    }
}
