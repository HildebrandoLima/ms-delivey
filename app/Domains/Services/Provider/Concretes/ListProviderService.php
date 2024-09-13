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

    public function listProviderAll(Pagination $pagination, string $search, bool $filter): Collection
    {
        if ($pagination->hasPagination($pagination)):
            return $this->providerRepository->hasPagination($search, $filter);
        else:
            return $this->providerRepository->noPagination($search, $filter);
        endif;
    }

    public function listProviderFind(int $id, bool $filter): Collection
    {
        return $this->providerRepository->readOne($id, $filter);
    }
}
