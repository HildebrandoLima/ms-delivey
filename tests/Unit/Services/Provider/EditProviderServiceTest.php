<?php

namespace Tests\Unit\Services\Provider;

use App\Http\Requests\Provider\EditProviderRequest;
use App\Models\Fornecedor;
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
        $this->request = new EditProviderRequest();
        

        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->providerRepository = $this->mock(IEntityRepository::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('update')->with(Fornecedor::class)->andReturn(true);
        });

        // Act
        $editProviderService = new EditProviderService($this->providerRepository);

        $result = $editProviderService->editProvider($this->request);

        // Assert
        $this->assertTrue($result);
    }
}
