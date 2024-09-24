<?php

namespace App\Domains\Services\Provider\Concretes;

use App\Data\Repositories\Provider\Interfaces\ICreateProviderRepository;
use App\Domains\Services\Provider\Interfaces\ICreateProviderService;
use App\Domains\Traits\RequestConfigurator;
use App\Http\Requests\Provider\CreateProviderRequest;
use App\Jobs\EmailForRegisterJob;

class CreateProviderService implements ICreateProviderService
{
    use RequestConfigurator;
    private ICreateProviderRepository $createProviderRepository;
    private int $providerId;

    public function __construct(ICreateProviderRepository $createProviderRepository)
    {
        $this->createProviderRepository = $createProviderRepository;
    }

    public function create(CreateProviderRequest $request): int
    {
        $this->setRequest($request);
        $this->created();
        $this->check();
        return $this->providerId;
    }

    public function created(): void
    {
        $this->providerId = $this->createProviderRepository->create($this->request);
    }

    public function check(): void
    {
        if ($this->providerId) $this->dispatchJob();
    }

    private function dispatchJob(): void
    {
        EmailForRegisterJob::dispatch($this->request->email, $this->providerId);
    }
}
