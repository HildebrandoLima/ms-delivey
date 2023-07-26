<?php

namespace App\Services\Product\Interfaces;

use App\Http\Requests\Product\ProductRequest;

interface CreateProductServiceInterface
{
    public function createProduct(ProductRequest $request): bool;
}
