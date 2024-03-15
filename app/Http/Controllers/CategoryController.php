<?php

namespace App\Http\Controllers;

use App\Exceptions\SystemDefaultException;
use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\EditCategoryRequest;
use App\Http\Requests\Category\ParamsCategoryRequest;
use App\Services\Category\Abstracts\ICreateCategoryService;
use App\Services\Category\Abstracts\IEditCategoryService;
use App\Services\Category\Abstracts\IListCategoryService;
use App\Support\Utils\Pagination\Pagination;
use App\Support\Utils\Params\FilterByActive;
use App\Support\Utils\Params\Search;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    private ICreateCategoryService $createCategoryService;
    private IEditCategoryService   $editCategoryService;
    private IListCategoryService   $listCategoryService;

    public function __construct
    (
        ICreateCategoryService $createCategoryService,
        IEditCategoryService   $editCategoryService,
        IListCategoryService   $listCategoryService
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
            return Controller::get($success);
        } catch (SystemDefaultException $e) {
            return Controller::error($e);
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
            return Controller::get($success);
        } catch (SystemDefaultException $e) {
            return Controller::error($e);
        }
    }

    public function update(EditCategoryRequest $request): Response
    {
        try {
            $success = $this->editCategoryService->editCategory($request);
            return Controller::put($success);
        } catch (SystemDefaultException $e) {
            return Controller::error($e);
        }
    }

    public function store(CreateCategoryRequest $request): Response
    {
        try {
            $success = $this->createCategoryService->createCategory($request);
            return Controller::post($success);
        } catch (SystemDefaultException $e) {
            return Controller::error($e);
        }
    }
}
