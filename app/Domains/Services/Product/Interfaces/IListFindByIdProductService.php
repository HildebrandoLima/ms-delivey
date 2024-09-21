<?php

namespace App\Domains\Services\Product\Interfaces;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface IListFindByIdProductService
{
    public function listFindById(Request $request): Collection;
}
