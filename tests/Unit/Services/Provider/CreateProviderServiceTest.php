<?php

namespace Tests\Unit\Services\Provider;

use App\Http\Requests\Provider\CreateProviderRequest;
use App\Models\Fornecedor;
use App\Repositories\Interfaces\ProviderRepositoryInterface;
use App\Services\Provider\Concretes\CreateProviderService;
use App\Support\Enums\PerfilEnum;
use App\Support\Traits\GenerateCNPJ;
use App\Support\Traits\GenerateEmail;
use Illuminate\Support\Str;
use Mockery\MockInterface;
use Tests\TestCase;

class CreateProviderServiceTest extends TestCase
{
    use GenerateCNPJ, GenerateEmail;
    private CreateProviderRequest $request;
    private ProviderRepositoryInterface $providerRepository;
    private int $id;

    public function test_success_create_provider_service(): void
    {
        // Arrange
        $this->id = rand(1, 100);
        $this->request = new CreateProviderRequest();
        $this->request['razaoSocial'] = Str::random(10);
        $this->request['cnpj'] = $this->generateCNPJ();
        $this->request['email'] = $this->generateEmail();
        $this->request['dataFundacao'] = date('Y-m-d H:i:s');
        $this->request['ativo'] = true;

        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->providerRepository = $this->mock(ProviderRepositoryInterface::class,
        function (MockInterface $mock) {
            $mock->shouldReceive('create')->with(Fornecedor::class)->andReturn($this->id);
        });

        // Act
        $createProviderService = new CreateProviderService($this->providerRepository);

        $result = $createProviderService->createProvider($this->request);

        // Assert
        $this->assertIsInt($result);
    }
}
