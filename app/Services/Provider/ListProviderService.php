<?php

namespace App\Services\Provider;

use App\Repositories\CheckRegisterRepository;
use App\Repositories\ProviderRepository;
use App\Services\Provider\Interfaces\IListProviderService;
use App\Support\Utils\Pagination\Pagination;
use Illuminate\Support\Collection;

class ListProviderService implements IListProviderService
{
    private CheckRegisterRepository $checkRegisterRepository;
    private ProviderRepository $providerRepository;

    public function __construct
    (
        CheckRegisterRepository $checkRegisterRepository,
        ProviderRepository $providerRepository
    )
    {
        $this->checkRegisterRepository = $checkRegisterRepository;
        $this->providerRepository      = $providerRepository;
    }

    public function listProviderAll(Pagination $pagination, string $search): Collection
    {
        return $this->providerRepository->getAll($pagination, $search);
    }

    public function listProviderFind(int $id): Collection
    {
        $this->checkRegisterRepository->checkProviderIdExist($id);
        return $this->providerRepository->getFind($id);
    }
}
