<?php

namespace App\Data\Repositories\Category\Interfaces;

use App\Http\Requests\Category\EditCategoryRequest;

interface IUpdateCategoryRepository
{
    public function update(EditCategoryRequest $request): bool;
}
