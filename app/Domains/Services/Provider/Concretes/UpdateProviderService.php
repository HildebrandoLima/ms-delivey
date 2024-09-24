<?php

namespace App\Domains\Services\Provider\Concretes;

use App\Data\Repositories\Provider\Interfaces\IUpdateProviderRepository;
use App\Domains\Services\Provider\Interfaces\IUpdateProviderService;
use App\Domains\Traits\RequestConfigurator;
use App\Http\Requests\Provider\UpdateProviderRequest;

class UpdateProviderService implements IUpdateProviderService
{
    use RequestConfigurator;
    private IUpdateProviderRepository $updateProviderRepository;

    public function __construct(IUpdateProviderRepository $updateProviderRepository)
    {
        $this->updateProviderRepository = $updateProviderRepository;
    }

    public function update(UpdateProviderRequest $request): bool
    {
        $this->setRequest($request);
        return $this->updated();
    }

    private function updated(): bool
    {
        return $this->updateProviderRepository->update($this->request);
    }
}
