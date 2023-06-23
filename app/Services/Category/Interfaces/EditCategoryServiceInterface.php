<?php

namespace App\Services\Category\Interfaces;

use App\Http\Requests\CategoryRequest;

interface EditCategoryServiceInterface
{
    public function editCategory(int $id, CategoryRequest $request): bool;
}
