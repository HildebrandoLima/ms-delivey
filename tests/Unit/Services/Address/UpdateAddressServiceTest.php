<?php

namespace Tests\Unit\Services\Address;

use App\Data\Repositories\Address\Interfaces\IUpdateAddressRepository;
use App\Domains\Services\Address\Concretes\UpdateAddressService;
use App\Http\Requests\Address\UpdateAddressRequest;
use Mockery\MockInterface;
use Tests\TestCase;

class UpdateAddressServiceTest extends TestCase
{
    private UpdateAddressRequest $request;
    private IUpdateAddressRepository $updateAddressRepository;
    private array $data = [];

    protected function setUp(): void
    {
        parent::setUp();
        $this->data = $this->setDataAddress();
    }

    public function test_success_edit_address__with_params_user_id_service(): void
    {
        // Arrange
        $this->request = new UpdateAddressRequest();
        $this->request['id'] = $this->data['id'];
        $this->request['logradouro'] = $this->data['logradouro'];
        $this->request['numero'] = $this->data['numero'];
        $this->request['bairro'] = $this->data['bairro'];
        $this->request['cidade'] = $this->data['cidade'];
        $this->request['cep'] = $this->data['cep'];
        $this->request['uf'] = $this->data['uf'];
        $this->request['usuarioId'] = $this->data['usuarioId'];
        $this->request['ativo'] = $this->data['ativo'];

        $this->updateAddressRepository = $this->mock(IUpdateAddressRepository::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('update')
                     ->with($this->request)
                     ->andReturn(true);
        });

        // Act
        $editAddressService = new UpdateAddressService($this->updateAddressRepository);
        $result = $editAddressService->update($this->request);

        // Assert
        $this->assertTrue($result);
        $this->assertEquals($this->request['id'], $this->data['id']);
        $this->assertEquals($this->request['logradouro'], $this->data['logradouro']);
        $this->assertEquals($this->request['numero'], $this->data['numero']);
        $this->assertEquals($this->request['bairro'], $this->data['bairro']);
        $this->assertEquals($this->request['cidade'], $this->data['cidade']);
        $this->assertEquals($this->request['cep'], $this->data['cep']);
        $this->assertEquals($this->request['uf'], $this->data['uf']);
        $this->assertEquals($this->request['usuarioId'], $this->data['usuarioId']);
    }

    public function test_success_edit_address__with_params_provider_id_service(): void
    {
        // Arrange
        $this->request = new UpdateAddressRequest();
        $this->request['id'] = $this->data['id'];
        $this->request['logradouro'] = $this->data['logradouro'];
        $this->request['numero'] = $this->data['numero'];
        $this->request['bairro'] = $this->data['bairro'];
        $this->request['cidade'] = $this->data['cidade'];
        $this->request['cep'] = $this->data['cep'];
        $this->request['uf'] = $this->data['uf'];
        $this->request['fornecedorId'] = $this->data['fornecedorId'];
        $this->request['ativo'] = $this->data['ativo'];

        $this->updateAddressRepository = $this->mock(IUpdateAddressRepository::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('update')
                     ->with($this->request)
                     ->andReturn(true);
        });

        // Act
        $editAddressService = new UpdateAddressService($this->updateAddressRepository);
        $result = $editAddressService->update($this->request);

        // Assert
        $this->assertTrue($result);
        $this->assertEquals($this->request['id'], $this->data['id']);
        $this->assertEquals($this->request['logradouro'], $this->data['logradouro']);
        $this->assertEquals($this->request['numero'], $this->data['numero']);
        $this->assertEquals($this->request['bairro'], $this->data['bairro']);
        $this->assertEquals($this->request['cidade'], $this->data['cidade']);
        $this->assertEquals($this->request['cep'], $this->data['cep']);
        $this->assertEquals($this->request['uf'], $this->data['uf']);
        $this->assertEquals($this->request['fornecedorId'], $this->data['fornecedorId']);
    }
}
