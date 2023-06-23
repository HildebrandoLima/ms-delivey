<?php

namespace App\Services\Product\Interfaces;

use Illuminate\Support\Collection;

interface ListProductServiceInterface
{
    public function listProductAll(int $active): Collection;
    public function listProductFind(int $id, string $search, int $active): Collection;
}
