<?php

namespace App\Http\Controllers;

use App\Exceptions\SystemDefaultException;
use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\EditCategoryRequest;
use App\Http\Requests\Category\ParamsCategoryRequest;
use App\Services\Category\Interfaces\CreateCategoryServiceInterface;
use App\Services\Category\Interfaces\EditCategoryServiceInterface;
use App\Services\Category\Interfaces\ListCategoryServiceInterface;
use App\Support\Utils\Pagination\Pagination;
use App\Support\Utils\Params\FilterByActive;
use App\Support\Utils\Params\Search;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    private CreateCategoryServiceInterface $createCategoryService;
    private EditCategoryServiceInterface   $editCategoryService;
    private ListCategoryServiceInterface   $listCategoryService;

    public function __construct
    (
        CreateCategoryServiceInterface $createCategoryService,
        EditCategoryServiceInterface   $editCategoryService,
        ListCategoryServiceInterface   $listCategoryService
    )
    {
        $this->createCategoryService = $createCategoryService;
        $this->editCategoryService   = $editCategoryService;
        $this->listCategoryService   = $listCategoryService;
    }

    public function index(Pagination $pagination, Search $search, FilterByActive $filter): Response
    {
        try {
            $success = $this->listCategoryService->listCategoryAll
            (
                $pagination,
                $search->search(request()),
                $filter->active
            );
            if (!$success) return Controller::error();
            return Controller::get($success);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function show(ParamsCategoryRequest $request, FilterByActive $filter): Response
    {
        try {
            $success = $this->listCategoryService->listCategoryFind
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

    public function update(EditCategoryRequest $request): Response
    {
        try {
            $success = $this->editCategoryService->editCategory($request);
            if (!$success) return Controller::error();
            return Controller::put();
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function store(CreateCategoryRequest $request): Response
    {
        try {
            $success = $this->createCategoryService->createCategory($request);
            if (!$success) return Controller::error();
            return Controller::post($success);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }
}
