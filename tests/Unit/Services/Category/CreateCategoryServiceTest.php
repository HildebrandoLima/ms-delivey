<?php

namespace Tests\Unit\Services\Category;

use App\Http\Requests\Category\CreateCategoryRequest;
use App\Models\Categoria;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Services\Category\Concretes\CreateCategoryService;
use App\Support\Enums\PerfilEnum;
use Illuminate\Support\Str;
use Mockery\MockInterface;
use Tests\TestCase;

class CreateCategoryServiceTest extends TestCase
{
    private CreateCategoryRequest $request;
    private CategoryRepositoryInterface $categoryRepository;

    public function test_success_create_category_service(): void
    {
        // Arrange
        $this->request = new CreateCategoryRequest();
        $this->request['nome'] = Str::random(10);
        $this->request['ativo'] = true;

        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->categoryRepository = $this->mock(CategoryRepositoryInterface::class,
        function (MockInterface $mock) {
            $mock->shouldReceive('create')->with(Categoria::class)->andReturn(true);
        });

        // Act
        $createCategoryService = new CreateCategoryService($this->categoryRepository);

        $result = $createCategoryService->createCategory($this->request);

        // Assert
        $this->assertTrue($result);
    }
}
