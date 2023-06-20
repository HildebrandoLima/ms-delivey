<?php

namespace App\Services\Provider;

use App\DataTransferObjects\RequestsDtos\ProviderRequestDto;
use App\Http\Requests\ProviderRequest;
use App\Jobs\EmailForRegisterJob;
use App\Repositories\CheckRegisterRepository;
use App\Repositories\Interfaces\ProviderRepositoryInterface;
use App\Services\Provider\Interfaces\ICreateProviderService;

class CreateProviderService implements ICreateProviderService
{
    private CheckRegisterRepository     $checkRegisterRepository;
    private ProviderRepositoryInterface $providerRepositoryInterface;

    public function __construct
    (
        CheckRegisterRepository     $checkRegisterRepository,
        ProviderRepositoryInterface $providerRepositoryInterface,
    )
    {
        $this->checkRegisterRepository     = $checkRegisterRepository;
        $this->providerRepositoryInterface = $providerRepositoryInterface;
    }

    public function createProvider(ProviderRequest $request): int
    {
        $this->checkExist($request);
        $provider = ProviderRequestDto::fromRquest($request);
        $createProvider = $this->providerRepositoryInterface->create($provider);
        if ($createProvider) $this->dispatchJob($createProvider->id, $request->email);
        return $createProvider->id;
    }

    public function checkExist(ProviderRequest $request): void
    {
        $this->checkRegisterRepository->checkProviderExist($request);
    }

    public function dispatchJob(int $providerId, string $email): void
    {
        EmailForRegisterJob::dispatch($email, $providerId);
    }
}
