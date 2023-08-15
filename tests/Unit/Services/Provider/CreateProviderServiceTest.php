<?php

namespace Tests\Unit\Services\Provider;

use App\Http\Requests\Provider\CreateProviderRequest;
use App\Models\Fornecedor;
use App\Repositories\Abstracts\IEntityRepository;
use App\Services\Provider\Concretes\CreateProviderService;
use App\Support\Enums\PerfilEnum;
use App\Support\Traits\GenerateEmail;
use Mockery\MockInterface;
use Tests\TestCase;

class CreateProviderServiceTest extends TestCase
{
    use GenerateEmail;
    private CreateProviderRequest $request;
    private IEntityRepository $providerRepository;

    public function test_success_create_provider_service(): void
    {
        // Arrange
        $this->request = new CreateProviderRequest();       
        $this->request['email'] = $this->generateEmail();

        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->providerRepository = $this->mock(IEntityRepository::class,
        function (MockInterface $mock) {
            $mock->shouldReceive('create')->with(Fornecedor::class)->andReturn(true);
        });

        // Act
        $createProviderService = new CreateProviderService($this->providerRepository);

        $result = $createProviderService->createProvider($this->request);

        // Assert
        $this->assertIsInt($result);
    }
}
