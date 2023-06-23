<?php

namespace App\Services\Category\Interfaces;

interface DeleteCategoryServiceInterface
{
    public function deleteCategory(int $id, int $active): bool;
}
