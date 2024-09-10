<?php

namespace Tests\Unit\Services\Category;

use App\Data\Repositories\Abstracts\IEntityRepository;
use App\Domains\Services\Category\Concretes\EditCategoryService;
use App\Http\Requests\Category\EditCategoryRequest;
use App\Models\Categoria;
use Mockery\MockInterface;
use Tests\TestCase;

class EditCategoryServiceTest extends TestCase
{
    private EditCategoryRequest $request;
    private IEntityRepository $categoryRepository;
    private array $data;

    protected function setUp(): void
    {
        parent::setUp();
        $this->data = $this->setDataCategory();
    }

    public function test_success_edit_category_service(): void
    {
        // Arrange
        $this->request = new EditCategoryRequest();
        $this->request['id'] = $this->data['id'];
        $this->request['nome'] = $this->data['nome'];
        $this->request['ativo'] = $this->data['ativo'];

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
        $this->assertEquals($this->request['id'], $this->data['id']);
        $this->assertEquals($this->request['nome'], $this->data['nome']);
        $this->assertEquals($this->request['ativo'], $this->data['ativo']);
    }
}
