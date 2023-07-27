<?php

namespace App\Services\Product\Interfaces;

use App\Http\Requests\Product\CreateProductRequest;

interface CreateProductServiceInterface
{
    public function createProduct(CreateProductRequest $request): bool;
}
