<?php

namespace App\Domains\Services\Telephone\Concretes;

use App\Data\Repositories\Telephone\Interfaces\ICreateTelephoneRepository;
use App\Domains\Services\Telephone\Abstracts\ICreateTelephoneService;
use App\Http\Requests\Telephone\CreateTelephoneRequest;

class CreateTelephoneService implements ICreateTelephoneService
{
    private ICreateTelephoneRepository $createTelephoneRepository;

    public function __construct(ICreateTelephoneRepository $createTelephoneRepository)
    {
        $this->createTelephoneRepository = $createTelephoneRepository;
    }

    public function createTelephone(CreateTelephoneRequest $request): bool
    {
        foreach ($request->all() as $telefone) {
            $this->createTelephoneRepository->create($telefone);
        }
        return true;
    }
}
