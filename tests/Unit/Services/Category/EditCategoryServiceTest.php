<?php

namespace Tests\Unit\Services\Category;

use App\Http\Requests\CategoryRequest;
use App\Models\Categoria;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Services\Category\Concretes\EditCategoryService;
use App\Support\Utils\Enums\PerfilEnum;
use Illuminate\Support\Str;
use Mockery\MockInterface;
use Tests\TestCase;

class EditCategoryServiceTest extends TestCase
{
    private CategoryRequest $request;
    private CheckEntityRepositoryInterface $checkEntityRepository;
    private CategoryRepositoryInterface $categoryRepository;

    public function test_success_edit_category_service(): void
    {
        // Arrange
        $id = rand(1, 100);
        $this->request = new CategoryRequest();
        $this->request['nome'] = Str::random(10);
        $this->request['ativo'] = true;

        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->checkEntityRepository = $this->mock(CheckEntityRepositoryInterface::class,
        function (MockInterface $mock) use ($id) {
            $mock->shouldReceive('checkCategoryIdExist')->with($id);
        });

        $this->categoryRepository = $this->mock(CategoryRepositoryInterface::class,
        function (MockInterface $mock) use ($id) {
            $mock->shouldReceive('update')->with($id, Categoria::class)->andReturn(true);
        });

        // Act
        $editCategoryService = new EditCategoryService
        (
            $this->checkEntityRepository,
            $this->categoryRepository
        );

        $result = $editCategoryService->editCategory($id, $this->request);

        // Assert
        $this->assertTrue($result);
    }
}
