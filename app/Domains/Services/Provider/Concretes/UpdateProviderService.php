<?php

namespace App\Domains\Services\Provider\Concretes;

use App\Data\Repositories\Provider\Interfaces\IUpdateProviderRepository;
use App\Domains\Services\Provider\Interfaces\IUpdateProviderService;
use App\Http\Requests\Provider\UpdateProviderRequest;

class UpdateProviderService implements IUpdateProviderService
{
    private IUpdateProviderRepository $updateProviderRepository;

    public function __construct(IUpdateProviderRepository $updateProviderRepository)
    {
        $this->updateProviderRepository = $updateProviderRepository;
    }

    public function update(UpdateProviderRequest $request): bool
    {
        return $this->updateProviderRepository->update($request);
    }
}
