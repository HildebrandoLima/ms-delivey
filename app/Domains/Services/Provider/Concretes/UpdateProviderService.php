<?php

namespace App\Domains\Services\Provider\Concretes;

use App\Data\Repositories\Provider\Interfaces\IUpdateProviderRepository;
use App\Domains\Services\Provider\Interfaces\IUpdateProviderService;
use App\Http\Requests\Provider\UpdateProviderRequest;

class UpdateProviderService implements IUpdateProviderService
{
    private IUpdateProviderRepository $updateProviderRepository;
    private UpdateProviderRequest $request;

    public function __construct(IUpdateProviderRepository $updateProviderRepository)
    {
        $this->updateProviderRepository = $updateProviderRepository;
    }

    public function update(UpdateProviderRequest $request): bool
    {
        $this->setRequest($request);
        return $this->updated();
    }

    private function setRequest(UpdateProviderRequest $request): void
    {
        $this->request = $request;
    }

    public function updated(): bool
    {
        return $this->updateProviderRepository->update($this->request);
    }
}
