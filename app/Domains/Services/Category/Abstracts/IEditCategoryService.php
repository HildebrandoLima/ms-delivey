<?php

namespace App\Domains\Services\Category\Abstracts;

use App\Http\Requests\Category\EditCategoryRequest;

interface IEditCategoryService
{
    public function editCategory(EditCategoryRequest $request): bool;
}
