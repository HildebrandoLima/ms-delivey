<?php

namespace Tests\Unit\Services\Address;

use App\Data\Repositories\Address\Interfaces\ICreateAddressRepository;
use App\Domains\Services\Address\Concretes\CreateAddressService;
use App\Http\Requests\Address\CreateAddressRequest;
use Mockery\MockInterface;
use Tests\TestCase;

class CreateAddressServiceTest extends TestCase
{
    private CreateAddressRequest $request;
    private ICreateAddressRepository $createAddressRepository;
    private array $data = [];

    protected function setUp(): void
    {
        parent::setUp();
        $this->data = $this->setDataAddress();
    }

    public function test_success_create_address_with_params_user_id_service(): void
    {
        // Arrange
        $this->request = new CreateAddressRequest();
        $this->request['logradouro'] = $this->data['logradouro'];
        $this->request['numero'] = $this->data['numero'];
        $this->request['bairro'] = $this->data['bairro'];
        $this->request['cidade'] = $this->data['cidade'];
        $this->request['cep'] = $this->data['cep'];
        $this->request['uf'] = $this->data['uf'];
        $this->request['usuarioId'] = $this->data['usuarioId'];

        $this->createAddressRepository = $this->mock(ICreateAddressRepository::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('create')
                      ->with($this->request)
                      ->andReturn(true);
        });

        // Act
        $createAddressService = new CreateAddressService($this->createAddressRepository);
        $result = $createAddressService->create($this->request);

        // Assert
        $this->assertTrue($result);
        $this->assertEquals($this->request['logradouro'], $this->data['logradouro']);
        $this->assertEquals($this->request['numero'], $this->data['numero']);
        $this->assertEquals($this->request['bairro'], $this->data['bairro']);
        $this->assertEquals($this->request['cidade'], $this->data['cidade']);
        $this->assertEquals($this->request['cep'], $this->data['cep']);
        $this->assertEquals($this->request['uf'], $this->data['uf']);
        $this->assertEquals($this->request['usuarioId'], $this->data['usuarioId']);
    }

    public function test_success_create_address_with_params_provider_id_service(): void
    {
        // Arrange
        $this->request = new CreateAddressRequest();
        $this->request['logradouro'] = $this->data['logradouro'];
        $this->request['numero'] = $this->data['numero'];
        $this->request['bairro'] = $this->data['bairro'];
        $this->request['cidade'] = $this->data['cidade'];
        $this->request['cep'] = $this->data['cep'];
        $this->request['uf'] = $this->data['uf'];
        $this->request['fornecedorId'] = $this->data['fornecedorId'];

        $this->createAddressRepository = $this->mock(ICreateAddressRepository::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('create')
                     ->with($this->request)
                     ->andReturn(true);
        });

        // Act
        $createAddressService = new CreateAddressService($this->createAddressRepository);
        $result = $createAddressService->create($this->request);

        // Assert
        $this->assertTrue($result);
        $this->assertEquals($this->request['logradouro'], $this->data['logradouro']);
        $this->assertEquals($this->request['numero'], $this->data['numero']);
        $this->assertEquals($this->request['bairro'], $this->data['bairro']);
        $this->assertEquals($this->request['cidade'], $this->data['cidade']);
        $this->assertEquals($this->request['cep'], $this->data['cep']);
        $this->assertEquals($this->request['uf'], $this->data['uf']);
        $this->assertEquals($this->request['fornecedorId'], $this->data['fornecedorId']);
    }
}
