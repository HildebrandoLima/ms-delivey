<?php

namespace App\Http\Controllers;

use App\Domains\Services\Category\Interfaces\ICreateCategoryService;
use App\Domains\Services\Category\Interfaces\IListAllCategoryService;
use App\Domains\Services\Category\Interfaces\IListFindByIdCategoryService;
use App\Domains\Services\Category\Interfaces\IUpdateCategoryService;
use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Requests\Category\ParamsCategoryRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Exception;

class CategoryController extends Controller
{
    private ICreateCategoryService       $createCategoryService;
    private IListAllCategoryService      $listAllCategoryService;
    private IListFindByIdCategoryService $listFindByIdCategoryService;
    private IUpdateCategoryService       $updateCategoryService;

    public function __construct
    (
        ICreateCategoryService       $createCategoryService,
        IListAllCategoryService      $listAllCategoryService,
        IListFindByIdCategoryService $listFindByIdCategoryService,
        IUpdateCategoryService       $updateCategoryService
    )
    {
        $this->createCategoryService       = $createCategoryService;
        $this->listAllCategoryService      = $listAllCategoryService;
        $this->listFindByIdCategoryService = $listFindByIdCategoryService;
        $this->updateCategoryService       = $updateCategoryService;
    }

    public function index(Request $request): Response
    {
        try {
            $success = $this->listAllCategoryService->listAll($request);
            return Controller::get($success);
        } catch (Exception $e) {
            return Controller::error($e);
        }
    }

    public function show(ParamsCategoryRequest $request): Response
    {
        try {
            $success = $this->listFindByIdCategoryService->listFindById($request);
            return Controller::get($success);
        } catch (Exception $e) {
            return Controller::error($e);
        }
    }

    public function update(UpdateCategoryRequest $request): Response
    {
        try {
            $success = $this->updateCategoryService->update($request);
            return Controller::put($success);
        } catch (Exception $e) {
            return Controller::error($e);
        }
    }

    public function store(CreateCategoryRequest $request): Response
    {
        try {
            $success = $this->createCategoryService->create($request);
            return Controller::post($success);
        } catch (Exception $e) {
            return Controller::error($e);
        }
    }
}
