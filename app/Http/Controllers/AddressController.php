<?php

namespace App\Http\Controllers;

use App\Domains\Services\Address\Abstracts\ICreateAddressService;
use App\Domains\Services\Address\Abstracts\IEditAddressService;
use App\Exceptions\SystemDefaultException;
use App\Http\Requests\Address\CreateAddressRequest;
use App\Http\Requests\Address\EditAddressRequest;
use Symfony\Component\HttpFoundation\Response;

class AddressController extends Controller
{
    private ICreateAddressService $createAddressService;
    private IEditAddressService   $editAddressService;

    public function __construct
    (
        ICreateAddressService $createAddressService,
        IEditAddressService   $editAddressService,
    )
    {
        $this->createAddressService = $createAddressService;
        $this->editAddressService   = $editAddressService;
    }

    public function store(CreateAddressRequest $request): Response
    {
        try {
            $success = $this->createAddressService->createAddress($request);
            return Controller::post($success);
        } catch (SystemDefaultException $e) {
            return Controller::error($e);
        }
    }

    public function update(EditAddressRequest $request): Response
    {
        try {
            $success = $this->editAddressService->editAddress($request);
            return Controller::put($success);
        } catch (SystemDefaultException $e) {
            return Controller::error($e);
        }
    }
}
