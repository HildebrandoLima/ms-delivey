<?php

namespace App\Services\Product\Interfaces;

interface DeleteProductServiceInterface
{
    public function deleteProduct(int $id, bool $active): bool;
}
