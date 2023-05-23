<?php

namespace App\Services\Provider;

use App\Repositories\CheckRegisterRepository;
use App\Repositories\ProviderRepository;
use App\Services\Provider\Interfaces\IDeleteProviderService;

class DeleteProviderService implements IDeleteProviderService
{
    private CheckRegisterRepository $checkRegisterRepository;
    private ProviderRepository $providerRepository;

    public function __construct
    (
        CheckRegisterRepository $checkRegisterRepository,
        ProviderRepository      $providerRepository
    )
    {
        $this->checkRegisterRepository = $checkRegisterRepository;
        $this->providerRepository      = $providerRepository;
    }

    public function deleteProvider(int $id): bool
    {
        $this->checkRegisterRepository->checkProviderIdExist($id);
        return $this->providerRepository->delete($id);
    }
}
