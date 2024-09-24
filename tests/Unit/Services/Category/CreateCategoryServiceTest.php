<?php

namespace Tests\Unit\Services\Category;

use App\Data\Repositories\Category\Interfaces\ICreateCategoryRepository;
use App\Domains\Services\Category\Concretes\CreateCategoryService;
use App\Http\Requests\Category\CreateCategoryRequest;
use Mockery\MockInterface;
use Tests\TestCase;

class CreateCategoryServiceTest extends TestCase
{
    private CreateCategoryRequest $request;
    private ICreateCategoryRepository $createCategoryRepository;
    private array $data = [];

    protected function setUp(): void
    {
        parent::setUp();
        $this->data = $this->setDataCategory();
    }

    public function test_success_create_category_service(): void
    {
        // Arrange
        $this->request = new CreateCategoryRequest();
        $this->request['nome'] = $this->data['nome'];

        $this->createCategoryRepository = $this->mock(ICreateCategoryRepository::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('create')
                    ->with($this->request)
                    ->andReturn(true);
        });

        // Act
        $createCategoryService = new CreateCategoryService($this->createCategoryRepository);
        $result = $createCategoryService->create($this->request);

        // Assert
        $this->assertTrue($result);
        $this->assertEquals($this->request['nome'], $this->data['nome']);
    }
}
