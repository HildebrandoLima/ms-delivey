<?php

namespace App\Services\Provider\Concretes;

use App\Repositories\Interfaces\ProviderRepositoryInterface;
use App\Services\Provider\Interfaces\ListProviderServiceInterface;
use Illuminate\Support\Collection;

class ListProviderService implements ListProviderServiceInterface
{
    private ProviderRepositoryInterface $providerRepository;

    public function __construct(ProviderRepositoryInterface $providerRepository)
    {
        $this->providerRepository = $providerRepository;
    }

    public function listProviderAll(string $search, bool $active): Collection
    {
        return $this->providerRepository->getAll($search, $active);
    }

    public function listProviderFind(int $id, bool $active): Collection
    {
        return $this->providerRepository->getOne($id, $active);
    }
}
