<?php

namespace App\Domains\Services\Product\Interfaces;

use App\Http\Requests\Product\CreateProductRequest;

interface ICreateProductService
{
    public function create(CreateProductRequest $request): bool;
}
