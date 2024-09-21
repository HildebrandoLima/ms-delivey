<?php

namespace App\Domains\Services\Telephone\Concretes;

use App\Data\Repositories\Telephone\Interfaces\IUpdateTelephoneRepository;
use App\Domains\Services\Telephone\Interfaces\IUpdateTelephoneService;
use App\Http\Requests\Telephone\UpdateTelephoneRequest;

class UpdateTelephoneService implements IUpdateTelephoneService
{
    private IUpdateTelephoneRepository $updateTelephoneRepository;
    private UpdateTelephoneRequest $request;

    public function __construct(IUpdateTelephoneRepository $updateTelephoneRepository)
    {
        $this->updateTelephoneRepository = $updateTelephoneRepository;
    }

    public function update(UpdateTelephoneRequest $request): bool
    {
        $this->setRequest($request);
        return $this->updated();
    }

    private function setRequest(UpdateTelephoneRequest $request): void
    {
        $this->request = $request;
    }

    private function updated(): bool
    {
        return $this->updateTelephoneRepository->update($this->request);
    }
}
