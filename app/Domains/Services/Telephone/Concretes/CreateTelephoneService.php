<?php

namespace App\Domains\Services\Telephone\Concretes;

use App\Data\Repositories\Telephone\Interfaces\ICreateTelephoneRepository;
use App\Domains\Services\Telephone\Interfaces\ICreateTelephoneService;
use App\Domains\Traits\RequestConfigurator;
use App\Http\Requests\Telephone\CreateTelephoneRequest;

class CreateTelephoneService implements ICreateTelephoneService
{
    use RequestConfigurator;
    private ICreateTelephoneRepository $createTelephoneRepository;

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

    private function created(): void
    {
        foreach ($this->request->all() as $telephone) {
            $this->createTelephoneRepository->create($telephone);
        }
    }
}
