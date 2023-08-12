<?php

namespace App\Http\Controllers;

use App\Exceptions\SystemDefaultException;
use App\Http\Requests\Telephone\CreateTelephoneRequest;
use App\Http\Requests\Telephone\EditTelephoneRequest;
use App\Services\Telephone\Abstracts\ICreateTelephoneService;
use App\Services\Telephone\Abstracts\IEditTelephoneService;
use Symfony\Component\HttpFoundation\Response;

class TelephoneController extends Controller
{
    private ICreateTelephoneService $createTelephoneService;
    private IEditTelephoneService   $editTelephoneService;

    public function __construct
    (
        ICreateTelephoneService $createTelephoneService,
        IEditTelephoneService   $editTelephoneService,
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
