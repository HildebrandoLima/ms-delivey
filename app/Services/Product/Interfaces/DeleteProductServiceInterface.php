<?php

namespace App\Services\Product\Interfaces;

interface DeleteProductServiceInterface
{
    public function deleteProduct(int $id, int $active): bool;
}
