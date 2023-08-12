<?php

namespace App\Services\Product\Abstracts;

use App\Http\Requests\Product\EditProductRequest;

interface IEditProductService
{
    public function editProduct(EditProductRequest $request): bool;
}
