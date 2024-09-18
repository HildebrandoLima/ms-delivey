<?php

namespace App\Domains\Services\Product\Abstracts;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface IListProductService
{
    public function listProductAll(Request $request): Collection;
    public function listProductFind(Request $request): Collection;
}
