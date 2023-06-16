<?php

namespace App\Http\Controllers;

use App\Exceptions\SystemDefaultException;
use App\Http\Requests\AddressRequest;
use App\Http\Requests\ParametersRequest;
use App\Services\Address\CreateAddressService;
use App\Services\Address\DeleteAddressService;
use App\Services\Address\EditAddressService;
use App\Services\Address\ListAddressService;
use App\Support\Utils\Parameters\BaseDecode;
use App\Support\Utils\Parameters\FilterByActive;
use Symfony\Component\HttpFoundation\Response;

class AddressController extends Controller
{
    private CreateAddressService    $createAddressService;
    private DeleteAddressService    $deleteAddressService;
    private EditAddressService      $editAddressService;
    private ListAddressService      $listAddressService;

    public function __construct
    (
        CreateAddressService    $createAddressService,
        DeleteAddressService    $deleteAddressService,
        EditAddressService      $editAddressService,
        ListAddressService      $listAddressService
    )
    {
        $this->createAddressService =  $createAddressService;
        $this->deleteAddressService =  $deleteAddressService;
        $this->editAddressService   =  $editAddressService;
        $this->listAddressService   =  $listAddressService;
    }

    public function uf(): Response
    {
        try {
            $success = $this->listAddressService->listFederativeUnitAll();
            if (!$success) return Controller::error();
            return Controller::get($success);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function index(ParametersRequest $request, BaseDecode $baseDecode, FilterByActive $filterByActive): Response
    {
        try {
            $success = $this->listAddressService->listAddressAll
            (
                $baseDecode->baseDecode($request->id),
                $filterByActive->filterByActive($request->active)
            );
            if (!$success) return Controller::error();
            return Controller::get($success);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function store(AddressRequest $request): Response
    {
        try {
            $success = $this->createAddressService->createAddress($request);
            if (!$success) return Controller::error();
            return Controller::post($success);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function update(string $id, AddressRequest $request, BaseDecode $baseDecode): Response
    {
        try {
            $success = $this->editAddressService->editAddress
            ($baseDecode->baseDecode($id), $request);
            if (!$success) return Controller::error();
            return Controller::put();
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function enableDisable(ParametersRequest $request, BaseDecode $baseDecode, FilterByActive $filterByActive): Response
    {
        try {
            $success = $this->deleteAddressService->deleteAddress
            (
                $baseDecode->baseDecode($request->id),
                $filterByActive->filterByActive($request->active)
            );
            if (!$success) return Controller::error();
            return Controller::delete();
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }
}
