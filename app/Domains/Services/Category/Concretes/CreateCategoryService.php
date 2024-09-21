<?php

namespace App\Domains\Services\Category\Concretes;

use App\Data\Repositories\Category\Interfaces\ICreateCategoryRepository;
use App\Domains\Services\Category\Interfaces\ICreateCategoryService;
use App\Http\Requests\Category\CreateCategoryRequest;

class CreateCategoryService implements ICreateCategoryService
{
    private ICreateCategoryRepository $createCategoryRepository;
    private CreateCategoryRequest $request;

    public function __construct(ICreateCategoryRepository $createCategoryRepository)
    {
        $this->createCategoryRepository = $createCategoryRepository;
    }

    public function create(CreateCategoryRequest $request): bool
    {
        $this->setRequest($request);
        return $this->created();
    }

    private function setRequest(CreateCategoryRequest $request): void
    {
        $this->request = $request;
    }

    private function created(): bool
    {
        return $this->createCategoryRepository->create($this->request);
    }
}
