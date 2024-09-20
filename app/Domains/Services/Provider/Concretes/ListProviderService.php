<?php

namespace App\Domains\Services\Provider\Concretes;

use App\Data\Repositories\Provider\Interfaces\IListAllProviderRepository;
use App\Domains\Services\Provider\Abstracts\IListProviderService;
use App\Support\Utils\Pagination\Pagination;
use App\Support\Utils\Params\Search;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ListProviderService implements IListProviderService
{
    private IListAllProviderRepository $listAllProviderRepository;

    public function __construct(IListAllProviderRepository $listAllProviderRepository)
    {
        $this->listAllProviderRepository = $listAllProviderRepository;
    }

    public function listProviderAll(Request $request): Collection
    {
        $pagination = new Pagination($request);
        $search = new Search($request);
        $active = (bool) $request->active;
        if ($pagination->hasPagination($pagination)) {
            return $this->listAllProviderRepository->hasPagination($search->getSearch(), $active);
        } else {
            return $this->listAllProviderRepository->noPagination($search->getSearch(), $active);
        }
    }

    public function listProviderFind(Request $request): Collection
    {
        return collect();
        //$this->providerRepository->readOne($request->id, (bool)$request->active);
    }
}
