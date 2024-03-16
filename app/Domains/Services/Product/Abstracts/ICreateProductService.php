<?php

namespace App\Domains\Services\Product\Abstracts;

use App\Http\Requests\Product\CreateProductRequest;

interface ICreateProductService
{
    public function createProduct(CreateProductRequest $request): bool;
}
