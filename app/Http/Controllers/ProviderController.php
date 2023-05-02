<?php

namespace App\Http\Controllers;

use App\Exceptions\SystemDefaultException;
use App\Http\Requests\ProviderRequest;
use App\Services\Provider\CreateProviderService;
use App\Services\Provider\DeleteProviderService;
use App\Services\Provider\EditProviderService;
use App\Services\Provider\ListProviderService;
use App\Support\Utils\Search;
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
            $search = new Search();
            $search = $search->search($request);
            $success = $this->listProviderService->listProviderAll($request, $search);
            if (!$success) return Controller::error();
            return Controller::get($success);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function show(string $id): Response
    {
        try {
            $search = new Search();
            $id = $search->id($id);
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

    public function update(string $id, ProviderRequest $request): Response
    {
        try {
            $search = new Search();
            $id = $search->id($id);
            $success = $this->editProviderService->editProvider($id, $request);
            if (!$success) return Controller::error();
            return Controller::put();
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function destroy(string $id): Response
    {
        try {
            $search = new Search();
            $id = $search->id($id);
            $success = $this->deleteProviderService->deleteProvider($id);
            if (!$success) return Controller::error();
            return Controller::put();
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }
}
