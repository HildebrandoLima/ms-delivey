<?php

namespace App\Domains\Services\Category\Interfaces;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface IListAllCategoryService
{
    public function listAll(Request $request): Collection;
}
