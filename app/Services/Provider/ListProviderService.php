<?php

namespace App\Services\Provider;

use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Repositories\Interfaces\ProviderRepositoryInterface;
use App\Services\Provider\Interfaces\IListProviderService;
use Illuminate\Support\Collection;

class ListProviderService implements IListProviderService
{
    private CheckEntityRepositoryInterface $checkEntityRepositoryInterface;
    private ProviderRepositoryInterface    $providerRepositoryInterface;

    public function __construct
    (
        CheckEntityRepositoryInterface $checkEntityRepositoryInterface,
        ProviderRepositoryInterface    $providerRepositoryInterface,
    )
    {
        $this->checkEntityRepositoryInterface = $checkEntityRepositoryInterface;
        $this->providerRepositoryInterface    = $providerRepositoryInterface;
    }

    public function listProviderAll(int $active): Collection
    {
        return $this->providerRepositoryInterface->getAll($active);
    }

    public function listProviderFind(int $id, string $search, int $activ): Collection
    {
        if ($id != 0) $this->checkEntityRepositoryInterface->checkProviderIdExist($id);
        return $this->providerRepositoryInterface->getOne($id, $search, $activ);
    }
}
