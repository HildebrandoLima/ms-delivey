<?php

namespace Tests\Unit\Services\Provider;

use App\Http\Requests\Provider\CreateProviderRequest;
use App\Jobs\EmailForRegisterJob;
use App\Domains\Models\Fornecedor;
use App\Repositories\Abstracts\IEntityRepository;
use App\Services\Provider\Concretes\CreateProviderService;
use App\Support\Enums\PerfilEnum;
use Illuminate\Support\Facades\Queue;
use Mockery\MockInterface;
use Tests\TestCase;

class CreateProviderServiceTest extends TestCase
{
    private CreateProviderRequest $request;
    private IEntityRepository $providerRepository;

    public function clearMockery(): void
    {
        $this->tearDown();
    }

    public function test_success_create_provider_service(): void
    {
        // Arrange
        $createdProvider = Fornecedor::query()->first();
        $this->request = new CreateProviderRequest();
        $this->request['razaoSocial'] = $createdProvider->razao_social;
        $this->request['cnpj'] = $createdProvider->cnpj;
        $this->request['email'] = $createdProvider->email;
        $this->request['dataFundacao'] = $createdProvider->data_fundacao;
        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->providerRepository = $this->mock(IEntityRepository::class,
        function (MockInterface $mock) {
            $mock->shouldReceive('create')->with(Fornecedor::class)->andReturn(true);
        });

        // Act
        Queue::fake();
        $createProviderService = new CreateProviderService($this->providerRepository);
        $result = $createProviderService->createProvider($this->request);
        $mappedProvider = $createProviderService->map($this->request);

        // Assert
        $this->assertIsInt($result);
        $this->assertInstanceOf(Fornecedor::class, $mappedProvider);
        $this->assertEquals($this->request['razaoSocial'], $createdProvider->razao_social);
        $this->assertEquals($this->request['cnpj'], $createdProvider->cnpj);
        $this->assertEquals($this->request['email'], $createdProvider->email);
        $this->assertEquals($this->request['dataFundacao'], $createdProvider->data_fundacao);

        Queue::assertPushed(EmailForRegisterJob::class, function ($provider) {
            return $provider;
        });
    }
}
