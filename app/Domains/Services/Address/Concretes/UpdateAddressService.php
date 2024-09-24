<?php

namespace App\Domains\Services\Address\Concretes;

use App\Data\Repositories\Address\Interfaces\IUpdateAddressRepository;
use App\Domains\Services\Address\Interfaces\IUpdateAddressService;
use App\Domains\Traits\RequestConfigurator;
use App\Http\Requests\Address\UpdateAddressRequest;

class UpdateAddressService implements IUpdateAddressService
{
    use RequestConfigurator;
    private IUpdateAddressRepository $updateAddressRepository;

    public function __construct(IUpdateAddressRepository $updateAddressRepository)
    {
        $this->updateAddressRepository = $updateAddressRepository;
    }

    public function update(UpdateAddressRequest $request): bool
    {
        $this->setRequest($request);
        return $this->updated();
    }

    private function updated(): bool
    {
        return $this->updateAddressRepository->update($this->request);
    }
}
