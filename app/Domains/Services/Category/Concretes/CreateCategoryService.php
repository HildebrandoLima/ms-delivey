<?php

namespace App\Domains\Services\Category\Concretes;

use App\Data\Repositories\Category\Interfaces\ICreateCategoryRepository;
use App\Domains\Services\Category\Abstracts\ICreateCategoryService;
use App\Http\Requests\Category\CreateCategoryRequest;

class CreateCategoryService implements ICreateCategoryService
{
    private ICreateCategoryRepository $createCategoryRepository;

    public function __construct(ICreateCategoryRepository $createCategoryRepository)
    {
        $this->createCategoryRepository = $createCategoryRepository;
    }

    public function createCategory(CreateCategoryRequest $request): bool
    {
        return $this->createCategoryRepository->create($request);
    }
}
