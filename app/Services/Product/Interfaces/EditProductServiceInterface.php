<?php

namespace App\Services\Product\Interfaces;

use App\Http\Requests\Product\EditProductRequest;

interface EditProductServiceInterface
{
    public function editProduct(EditProductRequest $request): bool;
}
