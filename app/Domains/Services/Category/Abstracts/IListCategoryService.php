<?php

namespace App\Domains\Services\Category\Abstracts;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface IListCategoryService
{
    public function listCategoryAll(Request $request): Collection;
    public function listCategoryFind(Request $request): Collection;
}
