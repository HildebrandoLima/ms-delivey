<?php

namespace App\Http\Controllers;

use App\Domains\Services\Provider\Abstracts\ICreateProviderService;
use App\Domains\Services\Provider\Abstracts\IEditProviderService;
use App\Domains\Services\Provider\Abstracts\IListProviderService;
use App\Http\Requests\Provider\CreateProviderRequest;
use App\Http\Requests\Provider\EditProviderRequest;
use App\Http\Requests\Provider\ParamsProviderRequest;
use App\Http\Requests\Provider\PermissonProviderRequest;
use App\Support\Utils\Pagination\Pagination;
use App\Support\Utils\Params\Search;
use Symfony\Component\HttpFoundation\Response;
use Exception;

class ProviderController extends Controller
{
    private ICreateProviderService $createProviderService;
    private IEditProviderService   $editProviderService;
    private IListProviderService   $listProviderService;

    public function __construct
    (
        ICreateProviderService $createProviderService,
        IEditProviderService   $editProviderService,
        IListProviderService   $listProviderService,
    )
    {
        $this->createProviderService = $createProviderService;
        $this->editProviderService   = $editProviderService;
        $this->listProviderService   = $listProviderService;
    }

    public function index(PermissonProviderRequest $request, Search $search): Response
    {
        try {
            $success = $this->listProviderService->listProviderAll
            (
                new Pagination($request),
                $search->search(request()),
                (bool)$request->active
            );
            return Controller::get($success);
        } catch (Exception $e) {
            return Controller::error($e);
        }
    }

    public function show(ParamsProviderRequest $request): Response
    {
        try {
            $success = $this->listProviderService->listProviderFind
            (
                $request->id,
                (bool)$request->active
            );
            return Controller::get($success);
        } catch (Exception $e) {
            return Controller::error($e);
        }
    }

    public function store(CreateProviderRequest $request): Response
    {
        try {
            $success = $this->createProviderService->createProvider($request);
            return Controller::post($success);
        } catch (Exception $e) {
            return Controller::error($e);
        }
    }

    public function update(EditProviderRequest $request): Response
    {
        try {
            $success = $this->editProviderService->editProvider($request);
            return Controller::put($success);
        } catch (Exception $e) {
            return Controller::error($e);
        }
    } 
}
