<?php

namespace App\Services\Product\Interfaces;

use App\Http\Requests\ProductRequest;

interface CreateProductServiceInterface
{
    public function createProduct(ProductRequest $request): bool;
}
