<?php

namespace App\Services\Category\Interfaces;

use App\Http\Requests\CategoryRequest;

interface CreateCategoryServiceInterface
{
    public function createCategory(CategoryRequest $request): int;
}
