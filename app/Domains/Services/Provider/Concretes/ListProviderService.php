<?php

namespace App\Domains\Services\Provider\Concretes;

use App\Data\Repositories\Abstracts\IProviderRepository;
use App\Domains\Services\Provider\Abstracts\IListProviderService;
use App\Support\Utils\Pagination\Pagination;
use App\Support\Utils\Params\Search;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ListProviderService implements IListProviderService
{
    private IProviderRepository $providerRepository;

    public function __construct(IProviderRepository $providerRepository)
    {
        $this->providerRepository = $providerRepository;
    }

    public function listProviderAll(Request $request): Collection
    {
        $pagination = new Pagination($request);
        $search = new Search($request);
        $active = (bool) $request->active;
        if ($pagination->hasPagination($pagination)) {
            return $this->providerRepository->hasPagination($search->getSearch(), $active);
        } else {
            return $this->providerRepository->noPagination($search->getSearch(), $active);
        }
    }

    public function listProviderFind(Request $request): Collection
    {
        return $this->providerRepository->readOne($request->id, (bool)$request->active);
    }
}
