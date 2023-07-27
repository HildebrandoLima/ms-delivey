<?php

namespace App\Http\Controllers;

use App\Exceptions\SystemDefaultException;
use App\Http\Requests\ParametersRequest;
use App\Http\Requests\Provider\CreateProviderRequest;
use App\Http\Requests\Provider\EditProviderRequest;
use App\Http\Requests\Provider\ParamsProviderRequest;
use App\Services\Provider\Interfaces\CreateProviderServiceInterface;
use App\Services\Provider\Interfaces\DeleteProviderServiceInterface;
use App\Services\Provider\Interfaces\EditProviderServiceInterface;
use App\Services\Provider\Interfaces\ListProviderServiceInterface;
use App\Support\Utils\Params\BaseDecode;
use App\Support\Utils\Params\FilterByActive;
use App\Support\Utils\Params\Search;
use Symfony\Component\HttpFoundation\Response;

class ProviderController extends Controller
{
    private CreateProviderServiceInterface   $createProviderService;
    private DeleteProviderServiceInterface   $deleteProviderService;
    private EditProviderServiceInterface     $editProviderService;
    private ListProviderServiceInterface     $listProviderService;

    public function __construct
    (
        CreateProviderServiceInterface   $createProviderService,
        DeleteProviderServiceInterface   $deleteProviderService,
        EditProviderServiceInterface     $editProviderService,
        ListProviderServiceInterface     $listProviderService
    )
    {
        $this->createProviderService    =   $createProviderService;
        $this->deleteProviderService    =   $deleteProviderService;
        $this->editProviderService      =   $editProviderService;
        $this->listProviderService      =   $listProviderService;
    }

    public function index(ParametersRequest $request, FilterByActive $filterByActive): Response
    {
        try {
            $success = $this->listProviderService->listProviderAll
            (
                $filterByActive::filterByActive($request->active)
            );
            if (!$success) return Controller::error();
            return Controller::get($success);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function show(ParametersRequest $request, BaseDecode $baseDecode, Search $search, FilterByActive $filterByActive): Response
    {
        try {
            $success = $this->listProviderService->listProviderFind
            (
                $baseDecode::baseDecode($request->id ?? ''),
                $search::search($request->search ?? ''),
                $filterByActive::filterByActive($request->active)
            );
            if (!$success) return Controller::error();
            return Controller::get($success);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function store(CreateProviderRequest $request): Response
    {
        try {
            $success = $this->createProviderService->createProvider($request);
            if (!$success) return Controller::error();
            return Controller::post($success);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function update(EditProviderRequest $request): Response
    {
        try {
            $success = $this->editProviderService->editProvider($request);
            if (!$success) return Controller::error();
            return Controller::put();
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function enableDisable(ParamsProviderRequest $request, FilterByActive $filter): Response
    {
        try {
            $success = $this->deleteProviderService->deleteProvider
            (
                $request->id,
                $filter->active
            );
            if (!$success) return Controller::error();
            return Controller::delete();
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }
}
