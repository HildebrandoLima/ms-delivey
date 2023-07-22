<?php

namespace Tests\Unit\Services\Address;

use App\Http\Requests\AddressRequest;
use App\Models\Endereco;
use App\Models\Fornecedor;
use App\Models\User;
use App\Repositories\Interfaces\AddressRepositoryInterface;
use App\Services\Address\Concretes\EditAddressService;
use App\Support\Enums\PerfilEnum;
use Illuminate\Support\Str;
use Mockery\MockInterface;
use Tests\TestCase;

class EditAddressServiceTest extends TestCase
{
    private AddressRequest $request;
    private AddressRepositoryInterface $addressRepository;
    private array $public_place = array('Rua', 'Avenida');
    private int $id;

    public function test_success_edit_address_with_params_user_id_service(): void
    {
        // Arrange
        $rand_keys = array_rand($this->public_place);
        $this->id = rand(1, 100);
        $this->request = new AddressRequest();
        $this->request['logradouro'] = $this->public_place[$rand_keys];
        $this->request['bairro'] = Str::random(10);
        $this->request['cidade'] = Str::random(10);
        $this->request['cep'] = rand(10000, 20000) . '-' . rand(100, 200);
        $this->request['ufId'] = rand(1, 27);
        $this->request['usuarioId'] = User::query()->first()->id;
        $this->request['ativo'] = true;

        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->addressRepository = $this->mock(AddressRepositoryInterface::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('update')->with($this->id, Endereco::class)->andReturn(true);
        });

        // Act
        $createAddressService = new EditAddressService($this->addressRepository);

        $result = $createAddressService->editAddress($this->id, $this->request);

        // Assert
        $this->assertTrue($result);
    }

    public function test_success_edit_address_with_params_provider_id_service(): void
    {
        // Arrange
        $rand_keys = array_rand($this->public_place);
        $this->id = rand(1, 100);
        $this->request = new AddressRequest();
        $this->request['logradouro'] = $this->public_place[$rand_keys];
        $this->request['bairro'] = Str::random(10);
        $this->request['cidade'] = Str::random(10);
        $this->request['cep'] = rand(10000, 20000) . '-' . rand(100, 200);
        $this->request['ufId'] = date('Y-m-d H:i:s');
        $this->request['fornecedorId'] = Fornecedor::query()->first()->id;
        $this->request['ativo'] = true;

        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->addressRepository = $this->mock(AddressRepositoryInterface::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('update')->with($this->id, Endereco::class)->andReturn(true);
        });

        // Act
        $createAddressService = new EditAddressService($this->addressRepository);

        $result = $createAddressService->editAddress($this->id, $this->request);

        // Assert
        $this->assertTrue($result);
    }
}
