<?php

namespace App\Services\Provider;

use App\Repositories\CheckRegisterRepository;
use App\Repositories\ProviderRepository;
use App\Services\Provider\Interfaces\IEmailProviderVerifiedAtService;

class EmailProviderVerifiedAtService implements IEmailProviderVerifiedAtService
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

    public function emailVerifiedAt(int $id, int $active): bool
    {
        $this->checkRegisterRepository->checkProviderIdExist($id);
        return $this->providerRepository->emailVerifiedAt($id, $active);
    }
}
