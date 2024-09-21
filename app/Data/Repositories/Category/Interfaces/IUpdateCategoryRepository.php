<?php

namespace App\Data\Repositories\Category\Interfaces;

use App\Http\Requests\Category\UpdateCategoryRequest;

interface IUpdateCategoryRepository
{
    public function update(UpdateCategoryRequest $request): bool;
}
