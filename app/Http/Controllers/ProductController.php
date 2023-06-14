<?php

namespace App\Http\Controllers;

use App\Exceptions\SystemDefaultException;
use App\Http\Requests\ParametersRequest;
use App\Http\Requests\ProductRequest;
use App\Services\Product\CreateProductService;
use App\Services\Product\DeleteProductService;
use App\Services\Product\EditProductSerice;
use App\Services\Product\ListProductService;
use App\Support\Utils\Pagination\Pagination;
use App\Support\Utils\Parameters\BaseDecode;
use App\Support\Utils\Parameters\FilterByActive;
use App\Support\Utils\Parameters\Search;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    private CreateProductService $createProductService;
    private DeleteProductService $deleteProductService;
    private EditProductSerice    $editProductSerice;
    private ListProductService   $listProductService;

    public function __construct
    (
        CreateProductService $createProductService,
        DeleteProductService $deleteProductService,
        EditProductSerice    $editProductSerice,
        ListProductService   $listProductService
    )
    {
        $this->createProductService = $createProductService;
        $this->deleteProductService = $deleteProductService;
        $this->editProductSerice    = $editProductSerice;
        $this->listProductService   = $listProductService;
    }

    public function index(Pagination $pagination, FilterByActive $filterByActive): Response
    {
        try {
            $success = $this->listProductService->listProductAll
            (
                $filterByActive->filterByActive($pagination->active)
            );
            if (!$success) return Controller::error();
            return Controller::get($success);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function show(ParametersRequest $request, BaseDecode $baseDecode, Search $search, FilterByActive $filterByActive): Response
    {
        try {
            $success = $this->listProductService->listProductFind
            (
                $baseDecode->baseDecode($request->id ?? ''),
                $search->search($request->search ?? ''),
                $filterByActive->filterByActive($request->active)
            );
            if (!$success) return Controller::error();
            return Controller::get($success);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function store(ProductRequest $request): Response
    {
        try {
            $success = $this->createProductService->createProduct($request);
            if (!$success) return Controller::error();
            return Controller::post($success);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function update(string $id, ProductRequest $request, BaseDecode $baseDecode): Response
    {
        try {
            $success = $this->editProductSerice->editProduct
            ($baseDecode->baseDecode($id), $request);
            if (!$success) return Controller::error();
            return Controller::put();
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function enableDisable(ParametersRequest $request, BaseDecode $baseDecode, FilterByActive $filterByActive): Response
    {
        try {
            $success = $this->deleteProductService->deleteProduct
            (
                $baseDecode->baseDecode($request->id),
                $filterByActive->filterByActive($request->active)
            );
            if (!$success) return Controller::error();
            return Controller::delete();
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }
}
