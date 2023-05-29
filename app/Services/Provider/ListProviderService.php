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

    public function listProviderAll(Pagination $pagination, int $active): Collection
    {
        return $this->providerRepository->getAll($pagination, $active);
    }

    public function listProviderFind(int $id, string $search, int $activ): Collection
    {
        if ($id != 0):
            $this->checkRegisterRepository->checkProviderIdExist($id);
        endif;
        return $this->providerRepository->getFind($id, $search, $activ);
    }
}
