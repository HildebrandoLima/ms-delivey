<?php

namespace Tests\Unit\Services\Provider;

use App\Data\Repositories\Abstracts\IEntityRepository;
use App\Domains\Services\Provider\Concretes\CreateProviderService;
use App\Http\Requests\Provider\CreateProviderRequest;
use App\Jobs\EmailForRegisterJob;
use App\Models\Fornecedor;
use Illuminate\Support\Facades\Queue;
use Mockery\MockInterface;
use Tests\TestCase;

class CreateProviderServiceTest extends TestCase
{
    private CreateProviderRequest $request;
    private IEntityRepository $providerRepository;
    private array $data;

    protected function setUp(): void
    {
        parent::setUp();
        $this->data = $this->setDataProvider();
    }

    public function test_success_create_provider_service(): void
    {
        // Arrange
        $this->request = new CreateProviderRequest();
        $this->request['razaoSocial'] = $this->data['razaoSocial'];
        $this->request['cnpj'] = $this->data['cnpj'];
        $this->request['email'] = $this->data['email'];
        $this->request['dataFundacao'] = $this->data['dataFundacao'];

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
        $this->assertEquals($this->request['razaoSocial'], $this->data['razaoSocial']);
        $this->assertEquals($this->request['cnpj'], $this->data['cnpj']);
        $this->assertEquals($this->request['email'], $this->data['email']);
        $this->assertEquals($this->request['dataFundacao'], $this->data['dataFundacao']);

        Queue::assertPushed(EmailForRegisterJob::class, function ($provider) {
            return $provider;
        });
    }
}
