<?php

namespace Tests\Unit\Services\Provider;

use App\Http\Requests\Provider\EditProviderRequest;
use App\Models\Fornecedor;
use App\Repositories\Interfaces\ProviderRepositoryInterface;
use App\Services\Provider\Concretes\EditProviderService;
use App\Support\Generate\GenerateCNPJ;
use App\Support\Generate\GenerateEmail;
use App\Support\Enums\PerfilEnum;
use Illuminate\Support\Str;
use Mockery\MockInterface;
use Tests\TestCase;

class EditProviderServiceTest extends TestCase
{
    private EditProviderRequest $request;
    private ProviderRepositoryInterface $providerRepository;

    public function test_success_edit_user_service(): void
    {
        // Arrange
        $this->request = new EditProviderRequest();
        $this->request['id'] = rand(1, 100);
        $this->request['razaoSocial'] = Str::random(10);
        $this->request['cnpj'] = GenerateCNPJ::generateCNPJ();
        $this->request['email'] = GenerateEmail::generateEmail();
        $this->request['dataFundacao'] = date('Y-m-d H:i:s');
        $this->request['ativo'] = true;

        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->providerRepository = $this->mock(ProviderRepositoryInterface::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('update')->with(Fornecedor::class)
                     ->andReturn(true);
        });

        // Act
        $editProviderService = new EditProviderService($this->providerRepository);

        $result = $editProviderService->editProvider($this->request);

        // Assert
        $this->assertTrue($result);
    }
}
