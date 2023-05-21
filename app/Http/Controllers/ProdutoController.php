<?php

namespace App\Http\Controllers;

use App\Exceptions\SystemDefaultException;
use App\Http\Requests\ProductRequest;
use App\Services\Product\CreateProductService;
use App\Services\Product\EditProductSerice;
use App\Services\Product\ListProductService;
use App\Support\Utils\Pagination\Pagination;
use App\Support\Utils\Parameters\BaseDecode;
use App\Support\Utils\Parameters\Search;
use Symfony\Component\HttpFoundation\Response;

class ProdutoController extends Controller
{
    private CreateProductService $createProductService;
    private EditProductSerice    $editProductSerice;
    private ListProductService   $listProductService;

    public function __construct
    (
        CreateProductService $createProductService,
        EditProductSerice    $editProductSerice,
        ListProductService   $listProductService
    )
    {
        $this->createProductService = $createProductService;
        $this->editProductSerice    = $editProductSerice;
        $this->listProductService   = $listProductService;
    }

    public function index(Pagination $pagination, Search $search): Response
    {
        try {
            $success = $this->listProductService->listProductAll
            ($pagination, $search->search($pagination->search ?? ''));
            if (!$success) return Controller::error();
            return Controller::get($success);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function show(string $id, BaseDecode $baseDecode): Response
    {
        try {
            $success = $this->listProductService->listProductFind($baseDecode->baseDecode($id));
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
}
