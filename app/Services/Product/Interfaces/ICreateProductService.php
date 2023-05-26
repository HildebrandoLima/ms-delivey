<?php

namespace App\Services\Product\Interfaces;

use App\Http\Requests\ProductRequest;

interface ICreateProductService
{
    public function createProduct(ProductRequest $request): bool;
}
