<?php

namespace App\Services\Provider\Concretes;

use App\Repositories\Abstracts\IProviderRepository;
use App\Services\Provider\Abstracts\IListProviderService;
use Illuminate\Support\Collection;

class ListProviderService implements IListProviderService
{
    private IProviderRepository $providerRepository;

    public function __construct(IProviderRepository $providerRepository)
    {
        $this->providerRepository = $providerRepository;
    }

    public function listProviderAll(string $search, bool $active): Collection
    {
        return $this->providerRepository->readAll($search, $active);
    }

    public function listProviderFind(int $id, bool $active): Collection
    {
        return $this->providerRepository->readOne($id, $active);
    }
}
