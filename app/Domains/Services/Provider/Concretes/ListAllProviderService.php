<?php

namespace App\Domains\Services\Provider\Concretes;

use App\Data\Repositories\Provider\Interfaces\IListAllProviderRepository;
use App\Domains\Services\Provider\Interfaces\IListAllProviderService;
use App\Support\Utils\Pagination\Pagination;
use App\Support\Utils\Params\Search;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ListAllProviderService implements IListAllProviderService
{
    private IListAllProviderRepository $listAllProviderRepository;

    public function __construct(IListAllProviderRepository $listAllProviderRepository)
    {
        $this->listAllProviderRepository = $listAllProviderRepository;
    }

    public function listAll(Request $request): Collection
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
}
