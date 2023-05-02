<?php

namespace App\Services\Provider;

use App\Http\Requests\Provider\ProviderRequest;
use App\Infra\Database\Dao\Provider\ListProviderDb;
use App\Repositories\ProviderRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ListProviderService
{
    private ProviderRepository $providerRepository;

    public function __construct(ProviderRepository $providerRepository)
    {
        $this->providerRepository = $providerRepository;
    }

    public function listProviderAll(Request $request): Collection
    {
        return $this->providerRepository->getAll($request);
    }

    public function listProviderFind(int $id): Collection
    {
        return $this->providerRepository->getFind($id);
    }
}
