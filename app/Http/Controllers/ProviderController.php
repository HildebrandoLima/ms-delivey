<?php

namespace App\Http\Controllers;

use App\Exceptions\SystemDefaultException;
use App\Http\Requests\Provider\CreateProviderRequest;
use App\Http\Requests\Provider\EditProviderRequest;
use App\Http\Requests\Provider\ParamsProviderRequest;
use App\Http\Requests\Provider\PermissonProviderRequest;
use App\Services\Provider\Interfaces\CreateProviderServiceInterface;
use App\Services\Provider\Interfaces\EditProviderServiceInterface;
use App\Services\Provider\Interfaces\ListProviderServiceInterface;
use App\Support\Utils\Params\FilterByActive;
use App\Support\Utils\Params\Search;
use Symfony\Component\HttpFoundation\Response;

class ProviderController extends Controller
{
    private CreateProviderServiceInterface $createProviderService;
    private EditProviderServiceInterface   $editProviderService;
    private ListProviderServiceInterface   $listProviderService;

    public function __construct
    (
        CreateProviderServiceInterface $createProviderService,
        EditProviderServiceInterface   $editProviderService,
        ListProviderServiceInterface   $listProviderService
    )
    {
        $this->createProviderService = $createProviderService;
        $this->editProviderService   = $editProviderService;
        $this->listProviderService   = $listProviderService;
    }

    public function index(PermissonProviderRequest $request, Search $search, FilterByActive $filter): Response
    {
        try {
            $success = $this->listProviderService->listProviderAll
            (
                $search->search(request()),
                $filter->active
            );
            if (!$success) return Controller::error();
            return Controller::get($success);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function show(ParamsProviderRequest $request, FilterByActive $filter): Response
    {
        try {
            $success = $this->listProviderService->listProviderFind
            (
                $request->id,
                $filter->active
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
}
