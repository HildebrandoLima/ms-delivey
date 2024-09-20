<?php

namespace App\Domains\Services\Provider\Concretes;

use App\Data\Repositories\Provider\Interfaces\ICreateProviderRepository;
use App\Domains\Services\Provider\Abstracts\ICreateProviderService;
use App\Http\Requests\Provider\CreateProviderRequest;
use App\Jobs\EmailForRegisterJob;

class CreateProviderService implements ICreateProviderService
{
    private ICreateProviderRepository $createProviderRepository;

    public function __construct(ICreateProviderRepository $createProviderRepository)
    {
        $this->createProviderRepository = $createProviderRepository;
    }

    public function createProvider(CreateProviderRequest $request): int
    {
        $providerId = $this->createProviderRepository->create($request);
        if ($providerId) $this->dispatchJob($request->email, $providerId);
        return $providerId;
    }

    private function dispatchJob(string $email, int $providerId): void
    {
        EmailForRegisterJob::dispatch($email, $providerId);
    }
}
