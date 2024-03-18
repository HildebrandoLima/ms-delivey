<?php

namespace App\Http\Controllers;

use App\Domains\Services\Telephone\Abstracts\ICreateTelephoneService;
use App\Domains\Services\Telephone\Abstracts\IEditTelephoneService;
use App\Exceptions\SystemDefaultException;
use App\Http\Requests\Telephone\CreateTelephoneRequest;
use App\Http\Requests\Telephone\EditTelephoneRequest;
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
            return Controller::post($success);
        } catch (SystemDefaultException $e) {
            return Controller::error($e);
        }
    }

    public function update(EditTelephoneRequest $request): Response
    {
        try {
            $success = $this->editTelephoneService->editTelephone($request);
            return Controller::put($success);
        } catch (SystemDefaultException $e) {
            return Controller::error($e);
        }
    }
}
