<?php

namespace Tests\Unit\Services\User;

use App\Http\Requests\AddressRequest;
use App\Models\Endereco;
use App\Models\Fornecedor;
use App\Models\User;
use App\Repositories\Interfaces\AddressRepositoryInterface;
use App\Services\Address\Concretes\CreateAddressService;
use Illuminate\Support\Str;
use Mockery\MockInterface;
use Tests\TestCase;

class CreateAddressServiceTest extends TestCase
{
    private AddressRequest $request;
    private AddressRepositoryInterface $addressRepository;
    private array $public_place = array('Rua', 'Avenida');

    public function test_success_create_address_with_params_user_id_service(): void
    {
        // Arrange
        $rand_keys = array_rand($this->public_place);
        $this->request = new AddressRequest();
        $this->request['logradouro'] = $this->public_place[$rand_keys];
        $this->request['bairro'] = Str::random(10);
        $this->request['cidade'] = Str::random(10);
        $this->request['cep'] = rand(10000, 20000) . '-' . rand(100, 200);
        $this->request['ufId'] = date('Y-m-d H:i:s');
        $this->request['usuarioId'] = User::query()->first()->id;
        $this->request['ativo'] = true;

        $this->addressRepository = $this->mock(AddressRepositoryInterface::class,
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
        $rand_keys = array_rand($this->public_place);
        $this->request = new AddressRequest();
        $this->request['logradouro'] = $this->public_place[$rand_keys];
        $this->request['bairro'] = Str::random(10);
        $this->request['cidade'] = Str::random(10);
        $this->request['cep'] = rand(10000, 20000) . '-' . rand(100, 200);
        $this->request['ufId'] = date('Y-m-d H:i:s');
        $this->request['fornecedorId'] = Fornecedor::query()->first()->id;
        $this->request['ativo'] = true;

        $this->addressRepository = $this->mock(AddressRepositoryInterface::class,
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
