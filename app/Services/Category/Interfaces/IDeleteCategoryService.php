<?php

namespace App\Services\Category\Interfaces;

interface IDeleteCategoryService
{
    public function deleteCategory(int $id): bool;
}
