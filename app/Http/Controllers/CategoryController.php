<?php

namespace App\Http\Controllers;

use App\Exceptions\SystemDefaultException;
use App\Http\Requests\CategoryRequest;
use App\Services\Category\CreateCategoryService;
use App\Services\Category\ListCategoryService;
use App\Support\Utils\Search;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    private CreateCategoryService $createCategoryService;
    private ListCategoryService $listCategoryService;

    public function __construct
    (
        CreateCategoryService $createCategoryService,
        ListCategoryService   $listCategoryService
    )
    {
        $this->createCategoryService = $createCategoryService;
        $this->listCategoryService   = $listCategoryService;
    }

    public function index(Request $request): Response
    {
        try {
            $search = new Search();
            $search = $search->search($request);
            $success = $this->listCategoryService->listCategoryAll($search);
            if (!$success) return Controller::error();
            return Controller::get($success);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function show(string $id): Response
    {
        try {
            $search = new Search();
            $id = $search->id($id);
            $success = $this->listCategoryService->listProviderFind($id);
            if (!$success) return Controller::error();
            return Controller::get($success);
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
}
