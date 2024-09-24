<?php

namespace App\Domains\Services\Category\Interfaces;

use App\Http\Requests\Category\UpdateCategoryRequest;

interface IUpdateCategoryService
{
    public function update(UpdateCategoryRequest $request): bool;
}
