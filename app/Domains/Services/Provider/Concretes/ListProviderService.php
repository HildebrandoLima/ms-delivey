<?php

namespace App\Domains\Services\Provider\Concretes;

use App\Data\Repositories\Abstracts\IProviderRepository;
use App\Domains\Services\Provider\Abstracts\IListProviderService;
use App\Support\Utils\Pagination\Pagination;
use Illuminate\Support\Collection;

class ListProviderService implements IListProviderService
{
    private IProviderRepository $providerRepository;

    public function __construct(IProviderRepository $providerRepository)
    {
        $this->providerRepository = $providerRepository;
    }

    public function listProviderAll(Pagination $pagination, string $search, bool $active): Collection
    {
        return $this->providerRepository->readAll($pagination, $search, $active);
    }

    public function listProviderFind(int $id, bool $active): Collection
    {
        return $this->providerRepository->readOne($id, $active);
    }
}
