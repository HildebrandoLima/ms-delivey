<?php

namespace Tests\Unit\Services\Category;

use App\Data\Repositories\Category\Interfaces\IUpdateCategoryRepository;
use App\Domains\Services\Category\Concretes\UpdateCategoryService;
use App\Http\Requests\Category\UpdateCategoryRequest;
use Mockery\MockInterface;
use Tests\TestCase;

class UpdateCategoryServiceTest extends TestCase
{
    private UpdateCategoryRequest $request;
    private IUpdateCategoryRepository $updateCategoryRepository;
    private array $data = [];

    protected function setUp(): void
    {
        parent::setUp();
        $this->data = $this->setDataCategory();
    }

    public function test_success_edit_category_service(): void
    {
        // Arrange
        $this->request = new UpdateCategoryRequest();
        $this->request['id'] = $this->data['id'];
        $this->request['nome'] = $this->data['nome'];
        $this->request['ativo'] = $this->data['ativo'];

        $this->updateCategoryRepository = $this->mock(IUpdateCategoryRepository::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('update')
                    ->with($this->request)
                    ->andReturn(true);
        });

        // Act
        $editCategoryService = new UpdateCategoryService($this->updateCategoryRepository);
        $result = $editCategoryService->update($this->request);

        // Assert
        $this->assertTrue($result);
        $this->assertEquals($this->request['id'], $this->data['id']);
        $this->assertEquals($this->request['nome'], $this->data['nome']);
        $this->assertEquals($this->request['ativo'], $this->data['ativo']);
    }
}
