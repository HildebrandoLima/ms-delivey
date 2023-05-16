<?php

namespace App\Http\Controllers;

use App\Exceptions\SystemDefaultException;
use App\Http\Requests\ProviderRequest;
use App\Services\Provider\CreateProviderService;
use App\Services\Provider\DeleteProviderService;
use App\Services\Provider\EditProviderService;
use App\Services\Provider\ListProviderService;
use App\Support\Utils\Pagination\Pagination;
use App\Support\Utils\Parameters\BaseDecode;
use App\Support\Utils\Parameters\Search;
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

    public function index(Pagination $pagination, Search $search): Response
    {
        try {
            $success = $this->listProviderService->listProviderAll
            ($pagination, $search->search($pagination->search ?? ''));
            if (!$success) return Controller::error();
            return Controller::get($success);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function show(string $id, BaseDecode $baseDecode): Response
    {
        try {
            $success = $this->listProviderService->listProviderFind($baseDecode->baseDecode($id));
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

    public function update(string $id, ProviderRequest $request, BaseDecode $baseDecode): Response
    {
        try {
            $success = $this->editProviderService->editProvider
            ($baseDecode->baseDecode($id), $request);
            if (!$success) return Controller::error();
            return Controller::put();
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function destroy(string $id, BaseDecode $baseDecode): Response
    {
        try {
            $success = $this->deleteProviderService->deleteProvider($baseDecode->baseDecode($id));
            if (!$success) return Controller::error();
            return Controller::delete();
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }
}
