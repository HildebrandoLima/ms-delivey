<?php

namespace App\Http\Controllers;

use App\Exceptions\SystemDefaultException;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\EditProductRequest;
use App\Http\Requests\Product\ParamsProductRequest;
use App\Services\Product\Abstracts\ICreateProductService;
use App\Services\Product\Abstracts\IEditProductService;
use App\Services\Product\Abstracts\IListProductService;
use App\Support\Utils\Pagination\Pagination;
use App\Support\Utils\Params\FilterByActive;
use App\Support\Utils\Params\Search;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    private ICreateProductService $createProductService;
    private IEditProductService   $editProductService;
    private IListProductService   $listProductService;

    public function __construct
    (
        ICreateProductService $createProductService,
        IEditProductService   $editProductService,
        IListProductService   $listProductService
    )
    {
        $this->createProductService = $createProductService;
        $this->editProductService   = $editProductService;
        $this->listProductService   = $listProductService;
    }

    public function index(Pagination $pagination, Search $search, FilterByActive $filter): Response
    {
        try {
            $success = $this->listProductService->listProductAll
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

    public function show(ParamsProductRequest $request, FilterByActive $filter): Response
    {
        try {
            $success = $this->listProductService->listProductFind
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

    public function store(CreateProductRequest $request): Response
    {
        try {
            $success = $this->createProductService->createProduct($request);
            if (!$success) return Controller::error();
            return Controller::post($success);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function update(EditProductRequest $request): Response
    {
        try {
            $success = $this->editProductService->editProduct($request);
            if (!$success) return Controller::error();
            return Controller::put();
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }
}
