<?php

namespace App\Http\Controllers;

use App\Domains\Services\Provider\Interfaces\ICreateProviderService;
use App\Domains\Services\Provider\Interfaces\IListAllProviderService;
use App\Domains\Services\Provider\Interfaces\IListFindByIdProviderService;
use App\Domains\Services\Provider\Interfaces\IUpdateProviderService;
use App\Http\Requests\Provider\CreateProviderRequest;
use App\Http\Requests\Provider\UpdateProviderRequest;
use App\Http\Requests\Provider\ParamsProviderRequest;
use App\Http\Requests\Provider\PermissonProviderRequest;
use Symfony\Component\HttpFoundation\Response;
use Exception;

class ProviderController extends Controller
{
    private ICreateProviderService       $createProviderService;
    private IListAllProviderService      $listAllProviderService;
    private IListFindByIdProviderService $listFindByIdProviderService;
    private IUpdateProviderService       $updateProviderService;

    public function __construct
    (
        ICreateProviderService       $createProviderService,
        IListAllProviderService      $listAllProviderService,
        IListFindByIdProviderService $listFindByIdProviderService,
        IUpdateProviderService       $updateProviderService
    )
    {
        $this->createProviderService       = $createProviderService;
        $this->listAllProviderService      = $listAllProviderService;
        $this->listFindByIdProviderService = $listFindByIdProviderService;
        $this->updateProviderService       = $updateProviderService;
    }

    public function index(PermissonProviderRequest $request): Response
    {
        try {
            $success = $this->listAllProviderService->listAll($request);
            return Controller::get($success);
        } catch (Exception $e) {
            return Controller::error($e);
        }
    }

    public function show(ParamsProviderRequest $request): Response
    {
        try {
            $success = $this->listFindByIdProviderService->listFindById($request);
            return Controller::get($success);
        } catch (Exception $e) {
            return Controller::error($e);
        }
    }

    public function store(CreateProviderRequest $request): Response
    {
        try {
            $success = $this->createProviderService->create($request);
            return Controller::post($success);
        } catch (Exception $e) {
            return Controller::error($e);
        }
    }

    public function update(UpdateProviderRequest $request): Response
    {
        try {
            $success = $this->updateProviderService->update($request);
            return Controller::put($success);
        } catch (Exception $e) {
            return Controller::error($e);
        }
    } 
}
