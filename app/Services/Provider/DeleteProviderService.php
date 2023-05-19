<?php

namespace App\Services\Provider;

use App\Repositories\ProviderRepository;
use App\Services\Provider\Interfaces\IDeleteProviderService;
use App\Support\Utils\CheckRegister\CheckProvider;

class DeleteProviderService implements IDeleteProviderService
{
    private CheckProvider $checkProvider;
    private ProviderRepository $providerRepository;

    public function __construct
    (
        CheckProvider      $checkProvider,
        ProviderRepository $providerRepository
    )
    {
        $this->checkProvider      = $checkProvider;
        $this->providerRepository = $providerRepository;
    }

    public function deleteProvider(int $id): bool
    {
        $this->checkProvider->checkProviderIdExist($id);
        return $this->providerRepository->delete($id);
    }
}
