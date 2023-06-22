<?php

namespace App\Services\Provider\Concretes;

use App\DataTransferObjects\RequestsDtos\ProviderRequestDto;
use App\Http\Requests\ProviderRequest;
use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Repositories\Interfaces\ProviderRepositoryInterface;
use App\Services\Provider\Interfaces\EditProviderServiceInterface;

class EditProviderService implements EditProviderServiceInterface
{
    private CheckEntityRepositoryInterface $checkEntityRepository;
    private ProviderRepositoryInterface    $providerRepository;

    public function __construct
    (
        CheckEntityRepositoryInterface $checkEntityRepository,
        ProviderRepositoryInterface    $providerRepository,
    )
    {
        $this->checkEntityRepository = $checkEntityRepository;
        $this->providerRepository    = $providerRepository;
    }

    public function editProvider(int $id, ProviderRequest $request): bool
    {
        $this->checkEntityRepository->checkProviderIdExist($id);
        $provider = ProviderRequestDto::fromRquest($request);
        return $this->providerRepository->update($id, $provider);
    }
}
