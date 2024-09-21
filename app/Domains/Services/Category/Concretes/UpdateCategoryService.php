<?php

namespace App\Domains\Services\Category\Concretes;

use App\Data\Repositories\Category\Interfaces\IUpdateCategoryRepository;
use App\Domains\Services\Category\Interfaces\IUpdateCategoryService;
use App\Http\Requests\Category\UpdateCategoryRequest;

class UpdateCategoryService implements IUpdateCategoryService
{
    private IUpdateCategoryRepository $updateCategoryRepository;
    private UpdateCategoryRequest $request;

    public function __construct(IUpdateCategoryRepository $updateCategoryRepository)
    {
        $this->updateCategoryRepository = $updateCategoryRepository;
    }

    public function update(UpdateCategoryRequest $request): bool
    {
        $this->setRequest($request);
        return $this->updated();
    }

    private function setRequest(UpdateCategoryRequest $request): void
    {
        $this->request = $request;
    }

    private function updated(): bool
    {
        return $this->updateCategoryRepository->update($this->request);
    }
}
