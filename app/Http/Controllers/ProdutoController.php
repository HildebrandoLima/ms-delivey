<?php

namespace App\Http\Controllers;

use App\Exceptions\SystemDefaultException;
use App\Http\Requests\ProductRequest;
use App\Services\Product\CreateProductService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProdutoController extends Controller
{
    private CreateProductService $createProductService;

    public function __construct
    (
        CreateProductService $createProductService
    )
    {
        $this->createProductService = $createProductService;
    }

    public function store(ProductRequest $request): Response
    {
        try {
            $success = $this->createProductService->createProduct($request);
            dd($success);
            if (!$success) return Controller::error();
            return Controller::post($success);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }
}
