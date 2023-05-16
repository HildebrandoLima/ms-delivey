<?php

namespace App\Services\Provider;

use App\Repositories\ProviderRepository;
use App\Services\Provider\Interfaces\IListProviderService;
use App\Support\Utils\Pagination\Pagination;
use Illuminate\Support\Collection;

class ListProviderService implements IListProviderService
{
    private ProviderRepository $providerRepository;

    public function __construct(ProviderRepository $providerRepository)
    {
        $this->providerRepository = $providerRepository;
    }

    public function listProviderAll(Pagination $pagination, string $search): Collection
    {
        return $this->providerRepository->getAll($pagination, $search);
    }

    public function listProviderFind(int $id): Collection
    {
        return $this->providerRepository->getFind($id);
    }
}
