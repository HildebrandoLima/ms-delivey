<?php

namespace Tests\Unit\Services\Address;

use App\Data\Repositories\Abstracts\IEntityRepository;
use App\Domains\Models\Endereco;
use App\Domains\Services\Address\Concretes\EditAddressService;
use App\Http\Requests\Address\EditAddressRequest;
use App\Support\Enums\PerfilEnum;
use Mockery\MockInterface;
use Tests\TestCase;

class EditAddressServiceTest extends TestCase
{
    private EditAddressRequest $request;
    private IEntityRepository $addressRepository;

    public function clearMockery(): void
    {
        $this->tearDown();
    }

    public function test_success_edit_address_service(): void
    {
        // Arrange
        $createdAddress = Endereco::query()->first();
        $this->request = new EditAddressRequest();
        $this->request['id'] = $createdAddress->id;
        $this->request['logradouro'] = $createdAddress->logradouro;
        $this->request['numero'] = $createdAddress->numero;
        $this->request['bairro'] = $createdAddress->bairro;
        $this->request['cidade'] = $createdAddress->cidade;
        $this->request['cep'] = $createdAddress->cep;
        $this->request['uf'] = $createdAddress->uf;
        $this->request['usuarioId'] = $createdAddress->usuario_id;
        $this->request['fornecedorId'] = $createdAddress->fornecedor_id;
        $this->request['ativo'] = $createdAddress->ativo;

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
        $mappedAddress = $editAddressService->map($this->request);

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
        $this->assertEquals($this->request['fornecedorId'], $createdAddress->fornecedor_id);
    }
}
