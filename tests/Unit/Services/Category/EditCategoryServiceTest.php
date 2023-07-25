<?php

namespace Tests\Unit\Services\Category;

use App\Http\Requests\Category\EditCategoryRequest;
use App\Models\Categoria;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Services\Category\Concretes\EditCategoryService;
use App\Support\Enums\PerfilEnum;
use Illuminate\Support\Str;
use Mockery\MockInterface;
use Tests\TestCase;

class EditCategoryServiceTest extends TestCase
{
    private EditCategoryRequest $request;
    private CategoryRepositoryInterface $categoryRepository;
    private int $id;

    public function test_success_edit_category_service(): void
    {
        // Arrange
        $this->request = new EditCategoryRequest();
        $this->id = rand(1, 100);
        $this->request['nome'] = Str::random(10);
        $this->request['ativo'] = true;

        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->categoryRepository = $this->mock(CategoryRepositoryInterface::class,
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
