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

    public function clearMockery(): void
    {
        $this->tearDown();
    }

    public function test_success_edit_category_service(): void
    {
        // Arrange
        $editedCategory = Categoria::query()->first();
        $this->request = new EditCategoryRequest();
        $this->request['nome'] = $editedCategory->nome;
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
        $mappedCategory = $editCategoryService->map($this->request);

        // Assert
        $this->assertTrue($result);
        $this->assertInstanceOf(Categoria::class, $mappedCategory);
        $this->assertEquals($this->request['nome'], $editedCategory->nome);
    }
}
