<?php

namespace Tests\Unit\Services\Address;

use App\Http\Requests\Address\EditAddressRequest;
use App\Models\Endereco;
use App\Repositories\Abstracts\IEntityRepository;
use App\Services\Address\Concretes\EditAddressService;
use App\Support\Enums\PerfilEnum;
use Mockery\MockInterface;
use Tests\TestCase;

class EditAddressServiceTest extends TestCase
{
    private EditAddressRequest $request;
    private IEntityRepository $addressRepository;

    public function test_success_edit_address_with_params_user_id_service(): void
    {
        // Arrange
        $this->request = new EditAddressRequest();

        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->addressRepository = $this->mock(IEntityRepository::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('update')->with(Endereco::class)->andReturn(true);
        });

        // Act
        $editAddressService = new EditAddressService($this->addressRepository);

        $result = $editAddressService->editAddress($this->request);

        // Assert
        $this->assertTrue($result);
    }

    public function test_success_edit_address_with_params_provider_id_service(): void
    {
        // Arrange
        $this->request = new EditAddressRequest();

        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->addressRepository = $this->mock(IEntityRepository::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('update')->with(Endereco::class)->andReturn(true);
        });

        // Act
        $editAddressService = new EditAddressService($this->addressRepository);

        $result = $editAddressService->editAddress($this->request);

        // Assert
        $this->assertTrue($result);
    }
}
