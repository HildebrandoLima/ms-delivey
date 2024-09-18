<?php

namespace App\Http\Controllers;

use App\Domains\Services\Product\Abstracts\ICreateProductService;
use App\Domains\Services\Product\Abstracts\IEditProductService;
use App\Domains\Services\Product\Abstracts\IListProductService;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\EditProductRequest;
use App\Http\Requests\Product\ParamsProductRequest;
use App\Support\Utils\Pagination\Pagination;
use App\Support\Utils\Params\FilterByActive;
use App\Support\Utils\Params\Search;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Exception;

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

    public function index(Request $request, Search $search, FilterByActive $filter): Response
    {
        try {
            $success = $this->listProductService->listProductAll
            (
                new Pagination($request),
                $search->search(request()),
                $filter->active
            );
            return Controller::get($success);
        } catch (Exception $e) {
            return Controller::error($e);
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
            return Controller::get($success);
        } catch (Exception $e) {
            return Controller::error($e);
        }
    }

    public function store(CreateProductRequest $request): Response
    {
        try {
            $success = $this->createProductService->createProduct($request);
            return Controller::post($success);
        } catch (Exception $e) {
            return Controller::error($e);
        }
    }

    public function update(EditProductRequest $request): Response
    {
        try {
            $success = $this->editProductService->editProduct($request);
            return Controller::put($success);
        } catch (Exception $e) {
            return Controller::error($e);
        }
    }
}
