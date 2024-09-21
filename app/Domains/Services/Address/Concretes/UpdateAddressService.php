<?php

namespace App\Domains\Services\Address\Concretes;

use App\Data\Repositories\Address\Interfaces\IUpdateAddressRepository;
use App\Domains\Services\Address\Interfaces\IUpdateAddressService;
use App\Http\Requests\Address\UpdateAddressRequest;

class UpdateAddressService implements IUpdateAddressService
{
    private IUpdateAddressRepository $updateAddressRepository;

    public function __construct(IUpdateAddressRepository $updateAddressRepository)
    {
        $this->updateAddressRepository = $updateAddressRepository;
    }

    public function update(UpdateAddressRequest $request): bool
    {
        return $this->updateAddressRepository->update($request);
    }
}
