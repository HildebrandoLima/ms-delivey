<?php

namespace App\Domains\Services\Telephone\Concretes;

use App\Data\Repositories\Telephone\Interfaces\IUpdateTelephoneRepository;
use App\Domains\Services\Telephone\Abstracts\IEditTelephoneService;
use App\Http\Requests\Telephone\EditTelephoneRequest;

class EditTelephoneService implements IEditTelephoneService
{
    private IUpdateTelephoneRepository $updateTelephoneRepository;

    public function __construct(IUpdateTelephoneRepository $updateTelephoneRepository)
    {
        $this->updateTelephoneRepository = $updateTelephoneRepository;
    }

    public function editTelephone(EditTelephoneRequest $request): bool
    {
        return $this->updateTelephoneRepository->update($request);
    }
}
