<?php

namespace Tests\Unit\Services\User;

use App\Models\UnidadeFederativa;
use App\Repositories\Interfaces\AddressRepositoryInterface;
use App\Services\Address\Concretes\ListAddressService;
use Mockery\MockInterface;
use Tests\TestCase;

class ListAddressServiceTest extends TestCase
{
    private AddressRepositoryInterface $addressRepository;

    public function test_success_list_user_all_service(): void
    {
        // Arrange
        $expectedResult = UnidadeFederativa::query()->get();

        $this->addressRepository = $this->mock(AddressRepositoryInterface::class,
            function (MockInterface $mock) use ($expectedResult) {
                $mock->shouldReceive('getFederativeUnitAll')->andReturn($expectedResult);
        });

        // Act
        $listAddressService = new ListAddressService
        (
            $this->addressRepository
        );

        $result = $listAddressService->listFederativeUnitAll();

        // Assert
        $this->assertSame($result, $expectedResult);
        $this->assertEquals(27, count($result->toArray()));
    }
}
