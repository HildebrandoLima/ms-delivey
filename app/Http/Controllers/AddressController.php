<?php

namespace App\Http\Controllers;

use App\Exceptions\SystemDefaultException;
use App\Http\Requests\Address\CreateAddressRequest;
use App\Http\Requests\Address\EditAddressRequest;
use App\Services\Address\Interfaces\CreateAddressServiceInterface;
use App\Services\Address\Interfaces\EditAddressServiceInterface;
use App\Services\Address\Interfaces\ListAddressServiceInterface;
use Symfony\Component\HttpFoundation\Response;

class AddressController extends Controller
{
    private CreateAddressServiceInterface $createAddressService;
    private EditAddressServiceInterface   $editAddressService;
    private ListAddressServiceInterface   $listAddressService;

    public function __construct
    (
        CreateAddressServiceInterface $createAddressService,
        EditAddressServiceInterface   $editAddressService,
        ListAddressServiceInterface   $listAddressService
    )
    {
        $this->createAddressService = $createAddressService;
        $this->editAddressService   = $editAddressService;
        $this->listAddressService   = $listAddressService;
    }

    public function index(): Response
    {
        try {
            $success = $this->listAddressService->listFederativeUnitAll();
            if (!$success) return Controller::error();
            return Controller::get($success);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function store(CreateAddressRequest $request): Response
    {
        try {
            $success = $this->createAddressService->createAddress($request);
            if (!$success) return Controller::error();
            return Controller::post($success);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function update(EditAddressRequest $request): Response
    {
        try {
            $success = $this->editAddressService->editAddress($request);
            if (!$success) return Controller::error();
            return Controller::put();
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }
}
