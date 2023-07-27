<?php

namespace Tests\Unit\Services\Telephone;

use App\Repositories\Interfaces\TelephoneRepositoryInterface;
use App\Services\Telephone\Concretes\ListTelephoneService;
use Mockery\MockInterface;
use Tests\TestCase;

class ListTelephoneServiceTest extends TestCase
{
    private TelephoneRepositoryInterface $telephoneRepository;

    public function test_success_list_telephone_ddd_service(): void
    {
        // Arrange
        $expectedResult = collect([]);

        $this->telephoneRepository = $this->mock(TelephoneRepositoryInterface::class,
            function (MockInterface $mock) use ($expectedResult) {
                $mock->shouldReceive('getDDDAll')->andReturn($expectedResult);
        });

        // Act
        $listTelephoneService = new ListTelephoneService($this->telephoneRepository);

        $result = $listTelephoneService->listDDDAll();

        // Assert
        $this->assertSame($result, $expectedResult);
    }
}
