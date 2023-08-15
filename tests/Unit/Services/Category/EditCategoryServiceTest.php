<?php

namespace Tests\Unit\Services\Category;

use App\Http\Requests\Category\EditCategoryRequest;
use App\Models\Categoria;
use App\Repositories\Abstracts\IEntityRepository;
use App\Services\Category\Concretes\EditCategoryService;
use App\Support\Enums\PerfilEnum;
use Mockery\MockInterface;
use Tests\TestCase;

class EditCategoryServiceTest extends TestCase
{
    private EditCategoryRequest $request;
    private IEntityRepository $categoryRepository;

    public function test_success_edit_category_service(): void
    {
        // Arrange
        $this->request = new EditCategoryRequest();

        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->categoryRepository = $this->mock(IEntityRepository::class,
        function (MockInterface $mock) {
            $mock->shouldReceive('update')->with(Categoria::class)->andReturn(true);
        });

        // Act
        $editCategoryService = new EditCategoryService($this->categoryRepository);

        $result = $editCategoryService->editCategory($this->request);

        // Assert
        $this->assertTrue($result);
    }
}
