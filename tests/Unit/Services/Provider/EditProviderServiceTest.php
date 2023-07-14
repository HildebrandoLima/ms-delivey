<?php

namespace Tests\Unit\Services\Provider;

use App\Http\Requests\ProviderRequest;
use App\Models\Fornecedor;
use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Repositories\Interfaces\ProviderRepositoryInterface;
use App\Services\Provider\Concretes\EditProviderService;
use App\Support\Generate\GenerateCNPJ;
use App\Support\Generate\GenerateEmail;
use App\Support\Utils\Enums\PerfilEnum;
use Illuminate\Support\Str;
use Mockery\MockInterface;
use Tests\TestCase;

class EditProviderServiceTest extends TestCase
{
    private ProviderRequest $request;
    private CheckEntityRepositoryInterface $checkEntityRepository;
    private ProviderRepositoryInterface $providerRepository;

    public function test_success_edit_user_service(): void
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
            function (MockInterface $mock) use ($id) {
                $mock->shouldReceive('checkProviderIdExist')->with($id);
        });

        $this->providerRepository = $this->mock(ProviderRepositoryInterface::class,
            function (MockInterface $mock) use ($id) {
                $mock->shouldReceive('update')->with($id, Fornecedor::class)->andReturn(1);
        });

        // Act
        $editProviderService = new EditProviderService
        (
            $this->checkEntityRepository,
            $this->providerRepository
        );

        $result = $editProviderService->editProvider($id, $this->request);

        // Assert
        $this->assertTrue($result);
    }
}
