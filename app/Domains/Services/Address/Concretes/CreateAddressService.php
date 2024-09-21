<?php

namespace App\Domains\Services\Address\Concretes;

use App\Data\Repositories\Address\Interfaces\ICreateAddressRepository;
use App\Domains\Services\Address\Interfaces\ICreateAddressService;
use App\Http\Requests\Address\CreateAddressRequest;

class CreateAddressService implements ICreateAddressService
{
    private ICreateAddressRepository $createAddressRepository;
    private CreateAddressRequest $request;

    public function __construct(ICreateAddressRepository $createAddressRepository)
    {
        $this->createAddressRepository = $createAddressRepository;
    }

    public function create(CreateAddressRequest $request): bool
    {
        $this->setRequest($request);
        return $this->created();
    }

    private function setRequest(CreateAddressRequest $request): void
    {
        $this->request = $request;
    }

    private function created(): bool
    {
        return $this->createAddressRepository->create($this->request);
    }
}
