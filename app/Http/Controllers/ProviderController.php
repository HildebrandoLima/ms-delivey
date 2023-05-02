<?php

namespace App\Http\Controllers;

use App\Exceptions\SystemDefaultException;
use App\Http\Requests\ProviderRequest;
use App\Http\Requests\Provider\EditProviderRequest;
//use App\Http\Requests\Provider\ProviderRequest;
use App\Services\Provider\CreateProviderService;
use App\Services\Provider\DeleteProviderService;
use App\Services\Provider\EditProviderService;
use App\Services\Provider\ListProviderService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProviderController extends Controller
{
    private CreateProviderService   $createProviderService;
    private DeleteProviderService   $deleteProviderService;
    private EditProviderService     $editProviderService;
    private ListProviderService     $listProviderService;

    public function __construct
    (
        CreateProviderService   $createProviderService,
        DeleteProviderService   $deleteProviderService,
        EditProviderService     $editProviderService,
        ListProviderService     $listProviderService
    )
    {
        $this->createProviderService    =   $createProviderService;
        $this->deleteProviderService    =   $deleteProviderService;
        $this->editProviderService      =   $editProviderService;
        $this->listProviderService      =   $listProviderService;
    }

    public function index(Request $request): Response
    {
        try {
            $success = $this->listProviderService->listProviderAll($request);
            if (!$success) return Controller::error();
            return Controller::get($success);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function show(int $id): Response
    {
        try {
            $success = $this->listProviderService->listProviderFind($id);
            if (!$success) return Controller::error();
            return Controller::get($success);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function store(ProviderRequest $request): Response
    {
        try {
            $success = $this->createProviderService->createProvider($request);
            if (!$success) return Controller::error();
            return Controller::post($success);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function update(int $id, ProviderRequest $request): Response
    {
        try {
            $success = $this->editProviderService->editProvider($id, $request);
            if (!$success) return Controller::error();
            return Controller::put();
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function destroy(int $id): Response
    {
        try {
            $success = $this->deleteProviderService->deleteProvider($id);
            if (!$success) return Controller::error();
            return Controller::put();
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }
}
