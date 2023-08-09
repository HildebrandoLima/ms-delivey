<?php

namespace App\Http\Controllers;

use App\Exceptions\SystemDefaultException;
use App\Http\Requests\Telephone\CreateTelephoneRequest;
use App\Http\Requests\Telephone\EditTelephoneRequest;
use App\Services\Telephone\Interfaces\CreateTelephoneServiceInterface;
use App\Services\Telephone\Interfaces\EditTelephoneServiceInterface;
use Symfony\Component\HttpFoundation\Response;

class TelephoneController extends Controller
{
    private CreateTelephoneServiceInterface $createTelephoneService;
    private EditTelephoneServiceInterface   $editTelephoneService;

    public function __construct
    (
        CreateTelephoneServiceInterface $createTelephoneService,
        EditTelephoneServiceInterface   $editTelephoneService,
    )
    {
        $this->createTelephoneService = $createTelephoneService;
        $this->editTelephoneService   = $editTelephoneService;
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
}
