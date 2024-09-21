<?php

namespace App\Domains\Services\Product\Interfaces;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface IListAllProductService
{
    public function listAll(Request $request): Collection;
}
