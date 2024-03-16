<?php

namespace Tests\Unit\Services\Category;

use App\Data\Repositories\Abstracts\IEntityRepository;
use App\Http\Requests\Category\CreateCategoryRequest;
use App\Domains\Models\Categoria;
use App\Services\Category\Concretes\CreateCategoryService;
use App\Support\Enums\PerfilEnum;
use Mockery\MockInterface;
use Tests\TestCase;

class CreateCategoryServiceTest extends TestCase
{
    private CreateCategoryRequest $request;
    private IEntityRepository $categoryRepository;

    public function clearMockery(): void
    {
        $this->tearDown();
    }

    public function test_success_create_category_service(): void
    {
        // Arrange
        $createdCategory = Categoria::query()->first();
        $this->request = new CreateCategoryRequest();
        $this->request['nome'] = $createdCategory->nome;
        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->categoryRepository = $this->mock(IEntityRepository::class,
        function (MockInterface $mock) {
            $mock->shouldReceive('create')->with(Categoria::class)->andReturn(true);
        });

        // Act
        $createCategoryService = new CreateCategoryService($this->categoryRepository);
        $result = $createCategoryService->createCategory($this->request);
        $mappedCategory = $createCategoryService->map($this->request);

        // Assert
        $this->assertTrue($result);
        $this->assertInstanceOf(Categoria::class, $mappedCategory);
        $this->assertEquals($this->request['nome'], $createdCategory->nome);
    }
}
