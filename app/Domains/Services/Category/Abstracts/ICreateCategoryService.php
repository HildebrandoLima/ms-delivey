<?php

namespace App\Domains\Services\Category\Abstracts;

use App\Http\Requests\Category\CreateCategoryRequest;

interface ICreateCategoryService
{
    public function createCategory(CreateCategoryRequest $request): bool;
}
