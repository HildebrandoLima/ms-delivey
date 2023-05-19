<?php

namespace App\Services\Category\Interfaces;

use App\Http\Requests\CategoryRequest;

interface ICreateCategoryService
{
    public function createCategory(CategoryRequest $request): int;
}
