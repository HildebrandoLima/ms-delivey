<?php

namespace App\Domains\Services\Category\Concretes;

use App\Data\Repositories\Category\Interfaces\IUpdateCategoryRepository;
use App\Domains\Services\Category\Abstracts\IEditCategoryService;
use App\Http\Requests\Category\EditCategoryRequest;
class EditCategoryService implements IEditCategoryService
{
    private IUpdateCategoryRepository $updateCategoryRepository;

    public function __construct(IUpdateCategoryRepository $updateCategoryRepository)
    {
        $this->updateCategoryRepository = $updateCategoryRepository;
    }

    public function editCategory(EditCategoryRequest $request): bool
    {
        return $this->updateCategoryRepository->update($request);
    }
}
