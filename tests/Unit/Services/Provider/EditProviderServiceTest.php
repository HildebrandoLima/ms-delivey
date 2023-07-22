<?php

namespace Tests\Unit\Services\Provider;

use App\Http\Requests\ProviderRequest;
use App\Models\Fornecedor;
use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
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
    private ProviderRequest $request;
    private CheckEntityRepositoryInterface $checkEntityRepository;
    private ProviderRepositoryInterface $providerRepository;
    private int $id;

    public function test_success_edit_user_service(): void
    {
        // Arrange
        $this->id = rand(1, 100);
        $this->request = new ProviderRequest();
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
                $mock->shouldReceive('checkProviderIdExist')->with($this->id);
        });

        $this->providerRepository = $this->mock(ProviderRepositoryInterface::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('update')->with($this->id, Fornecedor::class)
                     ->andReturn(true);
        });

        // Act
        $editProviderService = new EditProviderService
        (
            $this->checkEntityRepository,
            $this->providerRepository
        );

        $result = $editProviderService->editProvider($this->id, $this->request);

        // Assert
        $this->assertTrue($result);
    }
}
