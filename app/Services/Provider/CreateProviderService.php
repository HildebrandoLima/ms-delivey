<?php

namespace App\Services\Provider;

use App\Http\Requests\ProviderRequest;
use App\Jobs\EmailForRegisterJob;
use App\Repositories\ProviderRepository;
use App\Services\Provider\Interfaces\ICreateProviderService;
use App\Support\Utils\CheckRegister\CheckProvider;
use App\Support\Utils\MapToModel\ProviderModel;

class CreateProviderService implements ICreateProviderService
{
    private CheckProvider $checkProvider;
    private ProviderModel $providerModel;
    private ProviderRepository $providerRepository;

    public function __construct
    (
        CheckProvider      $checkProvider,
        ProviderModel      $providerModel,
        ProviderRepository $providerRepository
    )
    {
        $this->checkProvider      = $checkProvider;
        $this->providerModel      = $providerModel;
        $this->providerRepository = $providerRepository;
    }

    public function createProvider(ProviderRequest $request): int
    {
        $this->checkProvider->checkProviderExist($request);
        $provider = $this->providerModel->providerModel($request, 'create');
        $providerId = $this->providerRepository->insert($provider);
        EmailForRegisterJob::dispatch($request->email);
        return $providerId;
    }
}
