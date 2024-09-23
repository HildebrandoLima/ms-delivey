<?php

namespace App\Domains\Traits;

use App\Support\Utils\Pagination\Interface\IPagination;
use App\Support\Utils\Params\Interface\ISearch;
use Illuminate\Http\Request;

trait RequestConfigurator
{
    private Request $request;

    protected function setRequest(Request $request): void
    {
        $this->request = $request;
    }

    protected function setParams(Request $request, IPagination $pagination, ISearch $search): void
    {
        $pagination->setPage($request->page);
        $pagination->setPerPage($request->perPage);
        $search->setSearch($request->search);
    }
}
