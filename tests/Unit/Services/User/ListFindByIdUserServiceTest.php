<?php

namespace Tests\Unit\Services\User;

use App\Data\Repositories\User\Interfaces\IListFindByIdUserRepository;
use App\Domains\Services\User\Concretes\ListFindByIdUserService;
use Illuminate\Http\Request;
use Mockery\MockInterface;
use Tests\TestCase;

class ListFindByIdUserServiceTest extends TestCase
{
    private IListFindByIdUserRepository $listFindByIdUserRepository;
    private Request $request;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_success_list_category_find_by_id_service(): void
    {
        // Arrange
        $expectedResult = collect([]);
        $this->request = new Request(['id' => 1, 'active' => true]);

        $this->listFindByIdUserRepository = $this->mock(IListFindByIdUserRepository::class,
            function (MockInterface $mock) use ($expectedResult) {
                $mock->shouldReceive('listFindById')
                     ->with($this->request->id, $this->request->active)
                     ->andReturn($expectedResult);
        });

        // Act
        $listFindByIdUserService = new ListFindByIdUserService($this->listFindByIdUserRepository);
        $result = $listFindByIdUserService->listFindById($this->request);

        // Assert
        $this->assertEquals($expectedResult, $result);
    }
}
