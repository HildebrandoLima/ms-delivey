<?php

namespace App\Services\Provider;

use App\DataTransferObjects\RequestsDtos\ProviderRequestDto;
use App\Http\Requests\ProviderRequest;
use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Repositories\Interfaces\ProviderRepositoryInterface;
use App\Services\Provider\Interfaces\IEditProviderService;

class EditProviderService implements IEditProviderService
{
    private CheckEntityRepositoryInterface $checkEntityRepositoryInterface;
    private ProviderRepositoryInterface    $providerRepositoryInterface;

    public function __construct
    (
        CheckEntityRepositoryInterface $checkEntityRepositoryInterface,
        ProviderRepositoryInterface    $providerRepositoryInterface,
    )
    {
        $this->checkEntityRepositoryInterface = $checkEntityRepositoryInterface;
        $this->providerRepositoryInterface    = $providerRepositoryInterface;
    }

    public function editProvider(int $id, ProviderRequest $request): bool
    {
        $this->checkEntityRepositoryInterface->checkProviderIdExist($id);
        $provider = ProviderRequestDto::fromRquest($request);
        return $this->providerRepositoryInterface->update($id, $provider);
    }
}
