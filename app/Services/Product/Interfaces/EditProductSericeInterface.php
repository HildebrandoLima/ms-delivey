<?php

namespace App\Services\Product\Interfaces;

use App\Http\Requests\ProductRequest;

interface EditProductSericeInterface
{
    public function editProduct(int $id, ProductRequest $request): bool;
}
