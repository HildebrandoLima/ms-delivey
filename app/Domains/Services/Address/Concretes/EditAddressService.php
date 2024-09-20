<?php

namespace App\Domains\Services\Address\Concretes;

use App\Data\Repositories\Address\Interfaces\IUpdateAddressRepository;
use App\Domains\Services\Address\Abstracts\IEditAddressService;
use App\Http\Requests\Address\EditAddressRequest;

class EditAddressService implements IEditAddressService
{
    private IUpdateAddressRepository $updateAddressRepository;

    public function __construct(IUpdateAddressRepository $updateAddressRepository)
    {
        $this->updateAddressRepository = $updateAddressRepository;
    }

    public function editAddress(EditAddressRequest $request): bool
    {
        return $this->updateAddressRepository->update($request);
    }
}
