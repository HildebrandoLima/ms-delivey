<?php

namespace App\Domains\Services\Category\Interfaces;

use App\Http\Requests\Category\CreateCategoryRequest;

interface ICreateCategoryService
{
    public function create(CreateCategoryRequest $request): bool;
}
