<?php

namespace Tests\Unit\Services\Provider;

use App\Http\Requests\Provider\EditProviderRequest;
use App\Models\Endereco;
use App\Models\Fornecedor;
use App\Models\Telefone;
use App\Repositories\Abstracts\IEntityRepository;
use App\Services\Provider\Concretes\EditProviderService;
use App\Support\Enums\PerfilEnum;
use Mockery\MockInterface;
use Tests\TestCase;

class EditProviderServiceTest extends TestCase
{
    private EditProviderRequest $request;
    private IEntityRepository $providerRepository;

    public function test_success_edit_user_service(): void
    {
        // Arrange
        $editedProvider = Fornecedor::query()->first();
        $address = Endereco::query()->where('fornecedor_id', '=', $editedProvider->id)->first()->toArray();
        $telephone = Telefone::query()->where('fornecedor_id', '=', $editedProvider->id)->first()->toArray();
        $this->request = new EditProviderRequest();
        $this->request['id'] = $editedProvider->id;
        $this->request['razaoSocial'] = $editedProvider->razao_social;
        $this->request['cnpj'] = $editedProvider->cnpj;
        $this->request['email'] = $editedProvider->email;
        $this->request['dataFundacao'] = $editedProvider->data_fundacao;
        $this->request['ativo'] = $editedProvider->ativo;
        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

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
        $mappedAddress = $editProviderService->mapAddress($address['id'], $address['ativo']);
        $mappedTelephone = $editProviderService->mapTelephone($telephone['id'], $telephone['ativo']);
        $mappedProvider = $editProviderService->mapProvider($this->request);

        // Assert
        $this->assertTrue($result);
        $this->assertInstanceOf(Endereco::class, $mappedAddress);
        $this->assertInstanceOf(Telefone::class, $mappedTelephone);
        $this->assertInstanceOf(Fornecedor::class, $mappedProvider);
        $this->assertEquals($this->request['id'], $editedProvider->id);
        $this->assertEquals($this->request['razaoSocial'], $editedProvider->razao_social);
        $this->assertEquals($this->request['cnpj'], $editedProvider->cnpj);
        $this->assertEquals($this->request['email'], $editedProvider->email);
        $this->assertEquals($this->request['dataFundacao'], $editedProvider->data_fundacao);
        $this->assertEquals($this->request['ativo'], $editedProvider->ativo);
    }
}
