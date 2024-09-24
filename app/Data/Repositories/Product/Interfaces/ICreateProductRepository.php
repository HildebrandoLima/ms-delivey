<?php

namespace App\Data\Repositories\Product\Interfaces;

interface ICreateProductRepository
{
    public function create(array $product): bool;
}
