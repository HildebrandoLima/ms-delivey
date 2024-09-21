<?php

namespace App\Http\Controllers;

use App\Domains\Services\Product\Interfaces\ICreateProductService;
use App\Domains\Services\Product\Interfaces\IListAllProductService;
use App\Domains\Services\Product\Interfaces\IListFindByIdProductService;
use App\Domains\Services\Product\Interfaces\IUpdateProductService;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Requests\Product\ParamsProductRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Exception;

class ProductController extends Controller
{
    private ICreateProductService $createProductService;
    private IListAllProductService $listAllProductService;
    private IListFindByIdProductService $listFindByIdProductService;
    private IUpdateProductService $updateProductService;

    public function __construct
    (
        ICreateProductService       $createProductService,
        IListAllProductService      $listAllProductService,
        IListFindByIdProductService $listFindByIdProductService,
        IUpdateProductService       $updateProductService
    )
    {
        $this->createProductService       = $createProductService;
        $this->listAllProductService      = $listAllProductService;
        $this->listFindByIdProductService = $listFindByIdProductService;
        $this->updateProductService       = $updateProductService;
    }

    public function index(Request $request): Response
    {
        try {
            $success = $this->listAllProductService->listAll($request);
            return Controller::get($success);
        } catch (Exception $e) {
            return Controller::error($e);
        }
    }

    public function show(ParamsProductRequest $request): Response
    {
        try {
            $success = $this->listFindByIdProductService->listFindById($request);
            return Controller::get($success);
        } catch (Exception $e) {
            return Controller::error($e);
        }
    }

    public function store(CreateProductRequest $request): Response
    {
        try {
            $success = $this->createProductService->create($request);
            return Controller::post($success);
        } catch (Exception $e) {
            return Controller::error($e);
        }
    }

    public function update(UpdateProductRequest $request): Response
    {
        try {
            $success = $this->updateProductService->update($request);
            return Controller::put($success);
        } catch (Exception $e) {
            return Controller::error($e);
        }
    }
}
