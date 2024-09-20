<?php

namespace App\Data\Repositories\Category\Interfaces;

use App\Http\Requests\Category\CreateCategoryRequest;

interface ICreateCategoryRepository
{
    public function create(CreateCategoryRequest $request): bool;
}
