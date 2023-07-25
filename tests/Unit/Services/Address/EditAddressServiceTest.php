<?php

namespace Tests\Unit\Services\Address;

use App\Http\Requests\Address\EditAddressRequest;
use App\Models\Endereco;
use App\Repositories\Interfaces\AddressRepositoryInterface;
use App\Services\Address\Concretes\EditAddressService;
use App\Support\Enums\PerfilEnum;
use Mockery\MockInterface;
use Illuminate\Support\Str;
use Tests\TestCase;

class EditAddressServiceTest extends TestCase
{
    private EditAddressRequest $request;
    private AddressRepositoryInterface $addressRepository;
    private array $public_place = array('Rua', 'Avenida');

    public function test_success_edit_address_with_params_user_id_service(): void
    {
        // Arrange
        $rand_keys = array_rand($this->public_place);
        $this->request = new EditAddressRequest();
        $this->request['id'] = rand(1, 100);
        $this->request['logradouro'] = $this->public_place[$rand_keys];
        $this->request['bairro'] = Str::random(10);
        $this->request['cidade'] = Str::random(10);
        $this->request['cep'] = rand(10000, 20000) . '-' . rand(100, 200);
        $this->request['ufId'] = rand(1, 27);
        $this->request['usuarioId'] = rand(1, 100);
        $this->request['ativo'] = true;

        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->addressRepository = $this->mock(AddressRepositoryInterface::class,
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
        $rand_keys = array_rand($this->public_place);
        $this->request = new EditAddressRequest();
        $this->request['id'] = rand(1, 100);
        $this->request['logradouro'] = $this->public_place[$rand_keys];
        $this->request['bairro'] = Str::random(10);
        $this->request['cidade'] = Str::random(10);
        $this->request['cep'] = rand(10000, 20000) . '-' . rand(100, 200);
        $this->request['ufId'] = rand(1, 27);
        $this->request['fornecedorId'] = rand(1, 100);
        $this->request['ativo'] = true;

        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->addressRepository = $this->mock(AddressRepositoryInterface::class,
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
