<?php

namespace App\Http\Controllers;

use App\Exceptions\SystemDefaultException;
use App\Http\Requests\ParametersRequest;
use App\Http\Requests\ProductRequest;
use App\Services\Product\Interfaces\CreateProductServiceInterface;
use App\Services\Product\Interfaces\DeleteProductServiceInterface;
use App\Services\Product\Interfaces\EditProductServiceInterface;
use App\Services\Product\Interfaces\ListProductServiceInterface;
use App\Support\Utils\Pagination\Pagination;
use App\Support\Utils\Parameters\BaseDecode;
use App\Support\Utils\Parameters\FilterByActive;
use App\Support\Utils\Parameters\Search;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    private CreateProductServiceInterface $createProductService;
    private DeleteProductServiceInterface $deleteProductService;
    private EditProductServiceInterface   $editProductService;
    private ListProductServiceInterface   $listProductService;

    public function __construct
    (
        CreateProductServiceInterface $createProductService,
        DeleteProductServiceInterface $deleteProductService,
        EditProductServiceInterface   $editProductService,
        ListProductServiceInterface   $listProductService
    )
    {
        $this->createProductService = $createProductService;
        $this->deleteProductService = $deleteProductService;
        $this->editProductService    = $editProductService;
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
            $success = $this->editProductService->editProduct
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
