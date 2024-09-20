<?php

namespace App\Domains\Services\Provider\Concretes;

use App\Data\Repositories\Provider\Interfaces\IUpdateProviderRepository;
use App\Domains\Services\Provider\Abstracts\IEditProviderService;
use App\Http\Requests\Provider\EditProviderRequest;

class EditProviderService implements IEditProviderService
{
    private IUpdateProviderRepository $updateProviderRepository;

    public function __construct(IUpdateProviderRepository $updateProviderRepository)
    {
        $this->updateProviderRepository = $updateProviderRepository;
    }

    public function editProvider(EditProviderRequest $request): bool
    {
        return $this->updateProviderRepository->update($request);
    }
}
