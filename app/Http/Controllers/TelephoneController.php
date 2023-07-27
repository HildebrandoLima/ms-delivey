<?php

namespace App\Http\Controllers;

use App\Exceptions\SystemDefaultException;
use App\Http\Requests\ParametersRequest;
use App\Http\Requests\Telephone\CreateTelephoneRequest;
use App\Http\Requests\Telephone\EditTelephoneRequest;
use App\Services\Telephone\Interfaces\CreateTelephoneServiceInterface;
use App\Services\Telephone\Interfaces\DeleteTelephoneServiceInterface;
use App\Services\Telephone\Interfaces\EditTelephoneServiceInterface;
use App\Services\Telephone\Interfaces\ListTelephoneServiceInterface;
use App\Support\Utils\Params\BaseDecode;
use App\Support\Utils\Params\FilterByActive;
use Symfony\Component\HttpFoundation\Response;

class TelephoneController extends Controller
{
    private CreateTelephoneServiceInterface  $createTelephoneService;
    private DeleteTelephoneServiceInterface  $deleteTelephoneService;
    private EditTelephoneServiceInterface    $editTelephoneService;
    private ListTelephoneServiceInterface    $listTelephoneService;

    public function __construct
    (
        CreateTelephoneServiceInterface  $createTelephoneService,
        DeleteTelephoneServiceInterface  $deleteTelephoneService,
        EditTelephoneServiceInterface    $editTelephoneService,
        ListTelephoneServiceInterface    $listTelephoneService
    )
    {
        $this->createTelephoneService   =   $createTelephoneService;
        $this->deleteTelephoneService   =   $deleteTelephoneService;
        $this->editTelephoneService     =   $editTelephoneService;
        $this->listTelephoneService     =   $listTelephoneService;
    }

    public function index(): Response
    {
        try {
            $success = $this->listTelephoneService->listDDDAll();
            if (!$success) return Controller::error();
            return Controller::get($success);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function store(CreateTelephoneRequest $request): Response
    {
        try {
            $success = $this->createTelephoneService->createTelephone($request);
            if (!$success) return Controller::error();
            return Controller::post($success);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function update(EditTelephoneRequest $request): Response
    {
        try {
            $success = $this->editTelephoneService->editTelephone($request);
            if (!$success) return Controller::error();
            return Controller::put();
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function enableDisable(ParametersRequest $request, BaseDecode $baseDecode, FilterByActive $filterByActive): Response
    {
        try {
            $success = $this->deleteTelephoneService->deleteTelephone
            (
                $baseDecode::baseDecode($request->id),
                $filterByActive::filterByActive($request->active)
            );
            if (!$success) return Controller::error();
            return Controller::delete();
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }
}
