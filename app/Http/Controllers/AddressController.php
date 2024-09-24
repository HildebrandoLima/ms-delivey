<?php

namespace App\Http\Controllers;

use App\Domains\Services\Address\Interfaces\ICreateAddressService;
use App\Domains\Services\Address\Interfaces\IUpdateAddressService;
use App\Http\Requests\Address\CreateAddressRequest;
use App\Http\Requests\Address\UpdateAddressRequest;
use Symfony\Component\HttpFoundation\Response;
use Exception;

class AddressController extends Controller
{
    private ICreateAddressService $createAddressService;
    private IUpdateAddressService $updateAddressService;

    public function __construct
    (
        ICreateAddressService $createAddressService,
        IUpdateAddressService $updateAddressService,
    )
    {
        $this->createAddressService = $createAddressService;
        $this->updateAddressService = $updateAddressService;
    }

    public function store(CreateAddressRequest $request): Response
    {
        try {
            $success = $this->createAddressService->create($request);
            return Controller::post($success);
        } catch (Exception $e) {
            return Controller::error($e);
        }
    }

    public function update(UpdateAddressRequest $request): Response
    {
        try {
            $success = $this->updateAddressService->update($request);
            return Controller::put($success);
        } catch (Exception $e) {
            return Controller::error($e);
        }
    }
}
