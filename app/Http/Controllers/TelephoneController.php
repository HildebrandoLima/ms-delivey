<?php

namespace App\Http\Controllers;

use App\Exceptions\SystemDefaultException;
use App\Http\Requests\TelephoneRequest;
use App\Services\Telephone\CreateTelephoneService;
use App\Services\Telephone\DeleteTelephoneService;
use App\Services\Telephone\EditTelephoneService;
use App\Services\Telephone\ListTelephoneService;
use Symfony\Component\HttpFoundation\Response;

class TelephoneController extends Controller
{
    private CreateTelephoneService $createTelephoneService;
    private DeleteTelephoneService $deleteTelephoneService;
    private EditTelephoneService   $editTelephoneService;
    private ListTelephoneService   $listTelephoneService;

    public function __construct
    (
        CreateTelephoneService    $createTelephoneService,
        DeleteTelephoneService    $deleteTelephoneService,
        EditTelephoneService      $editTelephoneService,
        ListTelephoneService      $listTelephoneService
    )
    {
        $this->createTelephoneService    =   $createTelephoneService;
        $this->deleteTelephoneService    =   $deleteTelephoneService;
        $this->editTelephoneService      =   $editTelephoneService;
        $this->listTelephoneService      =   $listTelephoneService;
    }

    public function ddd(): Response
    {
        try {
            $success = $this->listTelephoneService->listDDDAll();
            if (!$success) return Controller::error();
            return Controller::get($success);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function index(int $id): Response
    {
        try {
            $success = $this->listTelephoneService->listTelephoneAll($id);
            if (!$success) return Controller::error();
            return Controller::get($success);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function store(TelephoneRequest $request): Response
    {
        try {
            $success = $this->createTelephoneService->createTelephone($request);
            if (!$success) return Controller::error();
            return Controller::post($success);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function update(int $id, TelephoneRequest $request): Response
    {
        try {
            $success = $this->editTelephoneService->editTelephone($id, $request);
            if (!$success) return Controller::error();
            return Controller::put();
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function destroy(int $id): Response
    {
        try {
            $success = $this->deleteTelephoneService->deleteTelephone($id);
            if (!$success) return Controller::error();
            return Controller::delete();
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }
}
