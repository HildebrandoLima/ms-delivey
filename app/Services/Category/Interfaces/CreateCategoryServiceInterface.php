<?php

namespace App\Services\Category\Interfaces;

use App\Http\Requests\Category\CreateCategoryRequest;

interface CreateCategoryServiceInterface
{
    public function createCategory(CreateCategoryRequest $request): bool;
}
