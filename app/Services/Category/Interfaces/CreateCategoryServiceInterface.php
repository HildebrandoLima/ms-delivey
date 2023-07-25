<?php

namespace App\Services\Category\Interfaces;

use App\Http\Requests\Category\CategoryRequest;

interface CreateCategoryServiceInterface
{
    public function createCategory(CategoryRequest $request): bool;
}
