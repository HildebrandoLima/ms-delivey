<?php

namespace App\Services\Provider;

use App\Http\Requests\Provider\ProviderRequest;
use App\Infra\Database\Dao\Provider\ListProviderDb;
use Illuminate\Support\Collection;

class ListProviderService
{
    private ListProviderDb $listProviderDb;

    public function __construct(ListProviderDb $listProviderDb)
    {
        $this->listProviderDb = $listProviderDb;
    }

    public function listProviderAll(): Collection
    {
        return $this->listProviderDb->listProviderAll();
    }

    public function listProviderFind(ProviderRequest $request): Collection
    {
        return $this->listProviderDb->listProviderFind($request);
    }
}
