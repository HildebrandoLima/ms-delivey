<?php

namespace App\Services\Product\Interfaces;

use App\Http\Requests\ProductRequest;

interface EditProductServiceInterface
{
    public function editProduct(int $id, ProductRequest $request): bool;
}
