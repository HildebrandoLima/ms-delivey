<?php

namespace App\Domains\Services\Telephone\Concretes;

use App\Data\Repositories\Telephone\Interfaces\IUpdateTelephoneRepository;
use App\Domains\Services\Telephone\Interfaces\IUpdateTelephoneService;
use App\Http\Requests\Telephone\UpdateTelephoneRequest;

class UpdateTelephoneService implements IUpdateTelephoneService
{
    private IUpdateTelephoneRepository $updateTelephoneRepository;

    public function __construct(IUpdateTelephoneRepository $updateTelephoneRepository)
    {
        $this->updateTelephoneRepository = $updateTelephoneRepository;
    }

    public function update(UpdateTelephoneRequest $request): bool
    {
        return $this->updateTelephoneRepository->update($request);
    }
}
