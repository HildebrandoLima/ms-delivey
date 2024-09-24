<?php

namespace App\Data\Repositories\Product\Interfaces;

interface IUpdateProductRepository
{
    public function update(array $product): bool;
}
