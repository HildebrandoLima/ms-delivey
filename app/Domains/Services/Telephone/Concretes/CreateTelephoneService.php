<?php

namespace App\Domains\Services\Telephone\Concretes;

use App\Data\Repositories\Telephone\Interfaces\ICreateTelephoneRepository;
use App\Domains\Services\Telephone\Interfaces\ICreateTelephoneService;
use App\Http\Requests\Telephone\CreateTelephoneRequest;

class CreateTelephoneService implements ICreateTelephoneService
{
    private ICreateTelephoneRepository $createTelephoneRepository;
    private CreateTelephoneRequest $request;

    public function __construct(ICreateTelephoneRepository $createTelephoneRepository)
    {
        $this->createTelephoneRepository = $createTelephoneRepository;
    }

    public function create(CreateTelephoneRequest $request): bool
    {
        $this->setRequest($request);
        $this->created();
        return true;
    }

    private function setRequest(CreateTelephoneRequest $request): void
    {
        $this->request = $request;
    }

    private function created(): void
    {
        foreach ($this->request->all() as $telephone) {
            $this->createTelephoneRepository->create($telephone);
        }
    }
}
