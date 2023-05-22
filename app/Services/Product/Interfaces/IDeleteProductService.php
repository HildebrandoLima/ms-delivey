<?php

namespace App\Services\Product\Interfaces;

interface IDeleteProductService
{
    public function deleteProduct(int $id): bool;
}
