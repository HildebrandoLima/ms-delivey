<?php

namespace Tests\Unit\Services\Category;

use App\Http\Requests\CategoryRequest;
use App\Models\Categoria;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Services\Category\Concretes\CreateCategoryService;
use App\Support\Utils\Enums\PerfilEnum;
use Illuminate\Support\Str;
use Mockery\MockInterface;
use Tests\TestCase;

class CreateCategoryServiceTest extends TestCase
{
    private CategoryRequest $request;
    private CheckEntityRepositoryInterface $checkEntityRepository;
    private CategoryRepositoryInterface $categoryRepository;

    public function test_success_create_category_service(): void
    {
        // Arrange
        $this->request = new CategoryRequest();
        $this->request['nome'] = Str::random(10);
        $this->request['ativo'] = true;

        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->checkEntityRepository = $this->mock(CheckEntityRepositoryInterface::class,
        function (MockInterface $mock) {
            $mock->shouldReceive('checkCategoryExist')->with($this->request);
        });

        $this->categoryRepository = $this->mock(CategoryRepositoryInterface::class,
        function (MockInterface $mock) {
            $mock->shouldReceive('create')->with(Categoria::class)->andReturn(true);
        });

        // Act
        $createCategoryService = new CreateCategoryService
        (
            $this->checkEntityRepository,
            $this->categoryRepository
        );

        $result = $createCategoryService->createCategory($this->request);

        // Assert
        $this->assertTrue($result);
    }
}
