<?php

namespace App\Http\Controllers;

use App\Exceptions\SystemDefaultException;
use App\Http\Requests\CategoryRequest;
use App\Services\Category\CreateCategoryService;
use App\Services\Category\DeleteCategoryService;
use App\Services\Category\EditCategoryService;
use App\Services\Category\ListCategoryService;
use App\Support\Utils\Pagination\Pagination;
use App\Support\Utils\Parameter\BaseDecode;
use App\Support\Utils\Parameter\Search;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    private CreateCategoryService $createCategoryService;
    private DeleteCategoryService $deleteCategoryService;
    private EditCategoryService $editCategoryService;
    private ListCategoryService $listCategoryService;

    public function __construct
    (
        CreateCategoryService $createCategoryService,
        DeleteCategoryService $deleteCategoryService,
        EditCategoryService   $editCategoryService,
        ListCategoryService   $listCategoryService
    )
    {
        $this->createCategoryService = $createCategoryService;
        $this->deleteCategoryService = $deleteCategoryService;
        $this->editCategoryService   = $editCategoryService;
        $this->listCategoryService   = $listCategoryService;
    }

    public function index(Pagination $pagination, Search $search): Response
    {
        try {
            $success = $this->listCategoryService->listCategoryAll
            ($search->search($pagination->search ?? ''));
            if (!$success) return Controller::error();
            return Controller::get($success);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function show(string $id, BaseDecode $baseDecode): Response
    {
        try {
            $success = $this->listCategoryService->listProviderFind($baseDecode->baseDecode($id));
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

    public function destroy(string $id, BaseDecode $baseDecode): Response
    {
        try {
            $success = $this->deleteCategoryService->deleteCategory($baseDecode->baseDecode($id));
            if (!$success) return Controller::error();
            return Controller::delete();
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }
}
