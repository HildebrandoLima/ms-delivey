<?php

namespace App\Http\Controllers;

use App\Exceptions\SystemDefaultException;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\ParametersRequest;
use App\Services\Category\Interfaces\CreateCategoryServiceInterface;
use App\Services\Category\Interfaces\DeleteCategoryServiceInterface;
use App\Services\Category\Interfaces\EditCategoryServiceInterface;
use App\Services\Category\Interfaces\ListCategoryServiceInterface;
use App\Support\Utils\Pagination\Pagination;
use App\Support\Utils\Parameters\BaseDecode;
use App\Support\Utils\Parameters\FilterByActive;
use App\Support\Utils\Parameters\Search;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    private CreateCategoryServiceInterface $createCategoryService;
    private DeleteCategoryServiceInterface $deleteCategoryService;
    private EditCategoryServiceInterface $editCategoryService;
    private ListCategoryServiceInterface $listCategoryService;

    public function __construct
    (
        CreateCategoryServiceInterface $createCategoryService,
        DeleteCategoryServiceInterface $deleteCategoryService,
        EditCategoryServiceInterface   $editCategoryService,
        ListCategoryServiceInterface   $listCategoryService
    )
    {
        $this->createCategoryService = $createCategoryService;
        $this->deleteCategoryService = $deleteCategoryService;
        $this->editCategoryService   = $editCategoryService;
        $this->listCategoryService   = $listCategoryService;
    }

    public function index(Pagination $pagination, ParametersRequest $request, FilterByActive $filterByActive): Response
    {
        try {
            $success = $this->listCategoryService->listCategoryAll
            (
                $pagination,
                $filterByActive::filterByActive($request->active)
            );
            if (!$success) return Controller::error();
            return Controller::get($success);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function show(ParametersRequest $request, Search $search, BaseDecode $baseDecode, FilterByActive $filterByActive): Response
    {
        try {
            $success = $this->listCategoryService->listCategoryFind
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

    public function update(string $id, CategoryRequest $request, BaseDecode $baseDecode): Response
    {
        try {
            $success = $this->editCategoryService->editCategory
            ($baseDecode->baseDecode($id), $request);
            if (!$success) return Controller::error();
            return Controller::put();
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function store(CategoryRequest $request): Response
    {
        try {
            $success = $this->createCategoryService->createCategory($request);
            if (!$success) return Controller::error();
            return Controller::post($success);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function enableDisable(ParametersRequest $request, BaseDecode $baseDecode, FilterByActive $filterByActive): Response
    {
        try {
            $success = $this->deleteCategoryService->deleteCategory
            (
                $baseDecode::baseDecode($request->id),
                $filterByActive::filterByActive($request->active)
            );
            if (!$success) return Controller::error();
            return Controller::delete();
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }
}
