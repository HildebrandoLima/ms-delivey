<?php

namespace Tests\Unit\Services\Address;

use App\Data\Repositories\Abstracts\IEntityRepository;
use App\Http\Requests\Address\CreateAddressRequest;
use App\Domains\Models\Endereco;
use App\Services\Address\Concretes\CreateAddressService;
use Mockery\MockInterface;
use Tests\TestCase;

class CreateAddressServiceTest extends TestCase
{
    private CreateAddressRequest $request;
    private IEntityRepository $addressRepository;

    public function clearMockery(): void
    {
        $this->tearDown();
    }

    public function test_success_create_address_with_params_user_id_service(): void
    {
        // Arrange
        $createdAddress = Endereco::query()->first();
        $this->request = new CreateAddressRequest();
        $this->request['logradouro'] = $createdAddress->logradouro;
        $this->request['numero'] = $createdAddress->numero;
        $this->request['bairro'] = $createdAddress->bairro;
        $this->request['cidade'] = $createdAddress->cidade;
        $this->request['cep'] = $createdAddress->cep;
        $this->request['uf'] = $createdAddress->uf;
        $this->request['usuarioId'] = $createdAddress->usuario_id;

        $this->addressRepository = $this->mock(IEntityRepository::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('create')->with(Endereco::class)->andReturn(true);
        });

        // Act
        $createAddressService = new CreateAddressService($this->addressRepository);
        $result = $createAddressService->createAddress($this->request);
        $mappedAddress = $createAddressService->map($this->request);

        // Assert
        $this->assertTrue($result);
        $this->assertInstanceOf(Endereco::class, $mappedAddress);
        $this->assertEquals($this->request['logradouro'], $createdAddress->logradouro);
        $this->assertEquals($this->request['numero'], $createdAddress->numero);
        $this->assertEquals($this->request['bairro'], $createdAddress->bairro);
        $this->assertEquals($this->request['cidade'], $createdAddress->cidade);
        $this->assertEquals($this->request['cep'], $createdAddress->cep);
        $this->assertEquals($this->request['uf'], $createdAddress->uf);
        $this->assertEquals($this->request['usuarioId'], $createdAddress->usuario_id);
    }

    public function test_success_create_address_with_params_provider_id_service(): void
    {
        // Arrange
        $createdAddress = Endereco::query()->first();
        $this->request = new CreateAddressRequest();
        $this->request['logradouro'] = $createdAddress->logradouro;
        $this->request['numero'] = $createdAddress->numero;
        $this->request['bairro'] = $createdAddress->bairro;
        $this->request['cidade'] = $createdAddress->cidade;
        $this->request['cep'] = $createdAddress->cep;
        $this->request['uf'] = $createdAddress->uf;
        $this->request['fornecedorId'] = $createdAddress->fornecedor_id;

        $this->addressRepository = $this->mock(IEntityRepository::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('create')->with(Endereco::class)->andReturn(true);
        });

        // Act
        $createAddressService = new CreateAddressService($this->addressRepository);
        $result = $createAddressService->createAddress($this->request);
        $mappedAddress = $createAddressService->map($this->request);

        // Assert
        $this->assertTrue($result);
        $this->assertInstanceOf(Endereco::class, $mappedAddress);
        $this->assertEquals($this->request['logradouro'], $createdAddress->logradouro);
        $this->assertEquals($this->request['numero'], $createdAddress->numero);
        $this->assertEquals($this->request['bairro'], $createdAddress->bairro);
        $this->assertEquals($this->request['cidade'], $createdAddress->cidade);
        $this->assertEquals($this->request['cep'], $createdAddress->cep);
        $this->assertEquals($this->request['uf'], $createdAddress->uf);
        $this->assertEquals($this->request['fornecedorId'], $createdAddress->fornecedor_id);
    }
}
