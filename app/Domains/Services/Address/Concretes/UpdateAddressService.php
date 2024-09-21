<?php

namespace App\Domains\Services\Address\Concretes;

use App\Data\Repositories\Address\Interfaces\IUpdateAddressRepository;
use App\Domains\Services\Address\Interfaces\IUpdateAddressService;
use App\Http\Requests\Address\UpdateAddressRequest;

class UpdateAddressService implements IUpdateAddressService
{
    private IUpdateAddressRepository $updateAddressRepository;
    private UpdateAddressRequest $request;

    public function __construct(IUpdateAddressRepository $updateAddressRepository)
    {
        $this->updateAddressRepository = $updateAddressRepository;
    }

    public function update(UpdateAddressRequest $request): bool
    {
        $this->setRequest($request);
        return $this->updated();
    }

    private function setRequest(UpdateAddressRequest $request): void
    {
        $this->request = $request;
    }

    private function updated(): bool
    {
        return $this->updateAddressRepository->update($this->request);
    }
}
