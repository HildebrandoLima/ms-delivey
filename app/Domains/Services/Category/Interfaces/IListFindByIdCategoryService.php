<?php

namespace App\Domains\Services\Category\Interfaces;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface IListFindByIdCategoryService
{
    public function listFindById(Request $request): Collection;
}
