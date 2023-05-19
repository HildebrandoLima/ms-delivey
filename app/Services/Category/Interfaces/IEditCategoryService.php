<?php

namespace App\Services\Category\Interfaces;

use App\Http\Requests\CategoryRequest;

interface IEditCategoryService
{
    public function editCategory(int $id, CategoryRequest $request): bool;
}
