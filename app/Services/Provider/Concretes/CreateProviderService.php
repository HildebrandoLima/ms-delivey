<?php

namespace App\Services\Provider\Concretes;

use App\DataTransferObjects\RequestsDtos\ProviderRequestDto;
use App\Http\Requests\ProviderRequest;
use App\Jobs\EmailForRegisterJob;
use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Repositories\Interfaces\ProviderRepositoryInterface;
use App\Services\Provider\Interfaces\CreateProviderServiceInterface;

class CreateProviderService implements CreateProviderServiceInterface
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
        $this->checkEntityRepositoryInterface->checkProviderExist($request);
    }

    public function dispatchJob(int $providerId, string $email): void
    {
        EmailForRegisterJob::dispatch($email, $providerId);
    }
}
