<?php

namespace Tests\Unit\Services\Provider;

use App\Http\Requests\ProviderRequest;
use App\Models\Fornecedor;
use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Repositories\Interfaces\ProviderRepositoryInterface;
use App\Services\Provider\Concretes\CreateProviderService;
use App\Support\Generate\GenerateCNPJ;
use App\Support\Generate\GenerateEmail;
use App\Support\Utils\Enums\PerfilEnum;
use Illuminate\Support\Str;
use Mockery\MockInterface;
use Tests\TestCase;

class CreateProviderServiceTest extends TestCase
{
    private ProviderRequest $request;
    private CheckEntityRepositoryInterface $checkEntityRepository;
    private ProviderRepositoryInterface $providerRepository;

    public function test_success_create_provider_service(): void
    {
        // Arrange
        $this->request = new ProviderRequest();
        $id = rand(1, 100);
        $this->request['razaoSocial'] = Str::random(10);
        $this->request['cnpj'] = GenerateCNPJ::generateCNPJ();
        $this->request['email'] = GenerateEmail::generateEmail();
        $this->request['dataFundacao'] = date('Y-m-d H:i:s');
        $this->request['ativo'] = true;

        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->checkEntityRepository = $this->mock(CheckEntityRepositoryInterface::class,
        function (MockInterface $mock) {
            $mock->shouldReceive('checkProviderExist')->with($this->request);
        });

        $this->providerRepository = $this->mock(ProviderRepositoryInterface::class,
        function (MockInterface $mock) use ($id) {
            $mock->shouldReceive('create')->with(Fornecedor::class)->andReturn($id);
        });

        // Act
        $createProviderService = new CreateProviderService
        (
            $this->checkEntityRepository,
            $this->providerRepository
        );

        $result = $createProviderService->createProvider($this->request);

        // Assert
        $this->assertIsInt($result);
    }
}