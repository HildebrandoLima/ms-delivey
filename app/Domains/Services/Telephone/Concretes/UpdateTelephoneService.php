<?php

namespace App\Domains\Services\Telephone\Concretes;

use App\Data\Repositories\Telephone\Interfaces\IUpdateTelephoneRepository;
use App\Domains\Services\Telephone\Interfaces\IUpdateTelephoneService;
use App\Domains\Traits\RequestConfigurator;
use App\Http\Requests\Telephone\UpdateTelephoneRequest;

class UpdateTelephoneService implements IUpdateTelephoneService
{
    use RequestConfigurator;
    private IUpdateTelephoneRepository $updateTelephoneRepository;

    public function __construct(IUpdateTelephoneRepository $updateTelephoneRepository)
    {
        $this->updateTelephoneRepository = $updateTelephoneRepository;
    }

    public function update(UpdateTelephoneRequest $request): bool
    {
        $this->setRequest($request);
        return $this->updated();
    }

    private function updated(): bool
    {
        return $this->updateTelephoneRepository->update($this->request);
    }
}
