<?php

namespace Tests\Unit\Services\Provider;

use App\Data\Repositories\Provider\Interfaces\ICreateProviderRepository;
use App\Domains\Services\Provider\Concretes\CreateProviderService;
use App\Http\Requests\Provider\CreateProviderRequest;
use App\Jobs\EmailForRegisterJob;
use Illuminate\Support\Facades\Queue;
use Mockery\MockInterface;
use Tests\TestCase;

class CreateProviderServiceTest extends TestCase
{
    private CreateProviderRequest $request;
    private ICreateProviderRepository $createProviderRepository;
    private array $data = [];

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

        $this->createProviderRepository = $this->mock(ICreateProviderRepository::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('create')
                     ->with($this->request)
                     ->andReturn(true);
        });

        // Act
        Queue::fake();
        $createProviderService = new CreateProviderService($this->createProviderRepository);
        $result = $createProviderService->create($this->request);

        // Assert
        $this->assertIsInt($result);
        $this->assertEquals($this->request['razaoSocial'], $this->data['razaoSocial']);
        $this->assertEquals($this->request['cnpj'], $this->data['cnpj']);
        $this->assertEquals($this->request['email'], $this->data['email']);
        $this->assertEquals($this->request['dataFundacao'], $this->data['dataFundacao']);

        Queue::assertPushed(EmailForRegisterJob::class,
            function ($provider) {
                return $provider;
        });
    }
}
