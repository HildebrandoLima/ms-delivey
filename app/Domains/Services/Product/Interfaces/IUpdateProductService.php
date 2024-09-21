<?php

namespace App\Domains\Services\Product\Interfaces;

use App\Http\Requests\Product\UpdateProductRequest;

interface IUpdateProductService
{
    public function update(UpdateProductRequest $request): bool;
}
