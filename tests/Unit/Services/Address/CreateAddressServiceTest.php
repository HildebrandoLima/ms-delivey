<?php

namespace Tests\Unit\Services\Address;

use App\Http\Requests\Address\CreateAddressRequest;
use App\Models\Endereco;
use App\Repositories\Abstracts\IEntityRepository;
use App\Services\Address\Concretes\CreateAddressService;
use Mockery\MockInterface;
use Tests\TestCase;

class CreateAddressServiceTest extends TestCase
{
    private CreateAddressRequest $request;
    private IEntityRepository $addressRepository;

    public function test_success_create_address_with_params_user_id_service(): void
    {
        // Arrange
        $this->request = new CreateAddressRequest();

        $this->addressRepository = $this->mock(IEntityRepository::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('create')->with(Endereco::class)->andReturn(true);
        });

        // Act
        $createAddressService = new CreateAddressService($this->addressRepository);

        $result = $createAddressService->createAddress($this->request);

        // Assert
        $this->assertTrue($result);
    }

    public function test_success_create_address_with_params_provider_id_service(): void
    {
        // Arrange
        $this->request = new CreateAddressRequest();

        $this->addressRepository = $this->mock(IEntityRepository::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('create')->with(Endereco::class)->andReturn(true);
        });

        // Act
        $createAddressService = new CreateAddressService($this->addressRepository);

        $result = $createAddressService->createAddress($this->request);

        // Assert
        $this->assertTrue($result);
    }
}
