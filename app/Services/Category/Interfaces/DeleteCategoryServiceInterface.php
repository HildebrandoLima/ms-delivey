<?php

namespace App\Services\Category\Interfaces;

use App\Http\Requests\Category\ParamsCategoryRequest;

interface DeleteCategoryServiceInterface
{
    public function deleteCategory(ParamsCategoryRequest $request): bool;
}
