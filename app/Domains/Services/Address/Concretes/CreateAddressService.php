<?php

namespace App\Domains\Services\Address\Concretes;

use App\Data\Repositories\Address\Interfaces\ICreateAddressRepository;
use App\Domains\Services\Address\Interfaces\ICreateAddressService;
use App\Http\Requests\Address\CreateAddressRequest;

class CreateAddressService implements ICreateAddressService
{
    private ICreateAddressRepository $createAddressRepository;

    public function __construct(ICreateAddressRepository $createAddressRepository)
    {
        $this->createAddressRepository = $createAddressRepository;
    }

    public function create(CreateAddressRequest $request): bool
    {
        return $this->createAddressRepository->create($request);
    }
}
