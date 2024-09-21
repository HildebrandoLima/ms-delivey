<?php

namespace App\Http\Controllers;

use App\Domains\Services\Telephone\Interfaces\ICreateTelephoneService;
use App\Domains\Services\Telephone\Interfaces\IUpdateTelephoneService;
use App\Http\Requests\Telephone\CreateTelephoneRequest;
use App\Http\Requests\Telephone\UpdateTelephoneRequest;
use Symfony\Component\HttpFoundation\Response;
use Exception;

class TelephoneController extends Controller
{
    private ICreateTelephoneService $createTelephoneService;
    private IUpdateTelephoneService $updateTelephoneService;

    public function __construct
    (
        ICreateTelephoneService $createTelephoneService,
        IUpdateTelephoneService $updateTelephoneService,
    )
    {
        $this->createTelephoneService = $createTelephoneService;
        $this->updateTelephoneService = $updateTelephoneService;
    }

    public function store(CreateTelephoneRequest $request): Response
    {
        try {
            $success = $this->createTelephoneService->create($request);
            return Controller::post($success);
        } catch (Exception $e) {
            return Controller::error($e);
        }
    }

    public function update(UpdateTelephoneRequest $request): Response
    {
        try {
            $success = $this->updateTelephoneService->update($request);
            return Controller::put($success);
        } catch (Exception $e) {
            return Controller::error($e);
        }
    }
}
