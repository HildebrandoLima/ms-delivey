<?php

namespace App\Services\Provider;

use App\Repositories\CheckRegisterRepository;
use App\Repositories\Interfaces\ProviderRepositoryInterface;
use App\Services\Provider\Interfaces\IListProviderService;
use Illuminate\Support\Collection;

class ListProviderService implements IListProviderService
{
    private CheckRegisterRepository     $checkRegisterRepository;
    private ProviderRepositoryInterface $providerRepositoryInterface;

    public function __construct
    (
        CheckRegisterRepository     $checkRegisterRepository,
        ProviderRepositoryInterface $providerRepositoryInterface,
    )
    {
        $this->checkRegisterRepository     = $checkRegisterRepository;
        $this->providerRepositoryInterface = $providerRepositoryInterface;
    }

    public function listProviderAll(int $active): Collection
    {
        return $this->providerRepositoryInterface->getAll($active);
    }

    public function listProviderFind(int $id, string $search, int $activ): Collection
    {
        if ($id != 0) $this->checkRegisterRepository->checkProviderIdExist($id);
        return $this->providerRepositoryInterface->getOne($id, $search, $activ);
    }
}
