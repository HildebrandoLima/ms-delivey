<?php

namespace Tests\Unit\Services\Provider;

use App\Data\Repositories\Abstracts\IEntityRepository;
use App\Domains\Services\Provider\Concretes\EditProviderService;
use App\Http\Requests\Provider\EditProviderRequest;
use App\Models\Endereco;
use App\Models\Fornecedor;
use App\Models\Telefone;
use Mockery\MockInterface;
use Tests\TestCase;

class EditProviderServiceTest extends TestCase
{
    private EditProviderRequest $request;
    private IEntityRepository $providerRepository;
    private array $data, $dataAddress, $dataPhone;

    protected function setUp(): void
    {
        parent::setUp();
        $this->dataAddress = $this->setDataAddress();
        $this->dataPhone = $this->setDataPhone();
        $this->data = $this->setDataProvider();
    }

    public function test_success_edit_user_service(): void
    {
        // Arrange
        $this->request = new EditProviderRequest();
        $this->request['id'] = $this->data['id'];
        $this->request['razaoSocial'] = $this->data['razaoSocial'];
        $this->request['cnpj'] = $this->data['cnpj'];
        $this->request['email'] = $this->data['email'];
        $this->request['dataFundacao'] = $this->data['dataFundacao'];
        $this->request['ativo'] = $this->data['ativo'];

        $this->providerRepository = $this->mock(IEntityRepository::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('read')->with(Fornecedor::class, $this->request['id'])->andReturn(collect([]));
                $mock->shouldReceive('update')->with(Endereco::class)->andReturn(true);
                $mock->shouldReceive('update')->with(Telefone::class)->andReturn(true);
                $mock->shouldReceive('update')->with(Fornecedor::class)->andReturn(true);    
        });

        // Act
        $editProviderService = new EditProviderService($this->providerRepository);
        $result = $editProviderService->editProvider($this->request);
        $mappedAddress = $editProviderService->mapAddress($this->dataAddress['id'], $this->dataAddress['ativo']);
        $mappedTelephone = $editProviderService->mapTelephone($this->dataPhone[0]['id'], $this->dataPhone[0]['ativo']);
        $mappedProvider = $editProviderService->mapProvider($this->request);

        // Assert
        $this->assertTrue($result);
        $this->assertInstanceOf(Endereco::class, $mappedAddress);
        $this->assertInstanceOf(Telefone::class, $mappedTelephone);
        $this->assertInstanceOf(Fornecedor::class, $mappedProvider);
        $this->assertEquals($this->request['id'], $this->data['id']);
        $this->assertEquals($this->request['razaoSocial'], $this->data['razaoSocial']);
        $this->assertEquals($this->request['cnpj'], $this->data['cnpj']);
        $this->assertEquals($this->request['email'], $this->data['email']);
        $this->assertEquals($this->request['dataFundacao'], $this->data['dataFundacao']);
        $this->assertEquals($this->request['ativo'], $this->data['ativo']);
    }
}
