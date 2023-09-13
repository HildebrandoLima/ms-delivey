<?php

namespace Tests\Unit\Services\Telephone;

use App\Http\Requests\Telephone\CreateTelephoneRequest;
use App\Models\Telefone;
use App\Repositories\Abstracts\IEntityRepository;
use App\Services\Telephone\Concretes\CreateTelephoneService;
use Mockery\MockInterface;
use Tests\TestCase;

class CreateTelephoneServiceTest extends TestCase
{
    private CreateTelephoneRequest $request;
    private IEntityRepository $telephoneRepository;

    public function test_success_create_telephone_with_params_user_id_service(): void
    {
        // Arrange
        $this->request = new CreateTelephoneRequest();

        $this->telephoneRepository = $this->mock(IEntityRepository::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('create')->with(Telefone::class)->andReturn(true);
        });

        // Act
        $createTelephoneService = new CreateTelephoneService($this->telephoneRepository);

        $result = $createTelephoneService->createTelephone($this->request);

        // Assert
        $this->assertTrue($result);
    }

    public function test_success_create_telephone_with_params_provider_id_service(): void
    {
        // Arrange
        $this->request = new CreateTelephoneRequest();

        $this->telephoneRepository = $this->mock(IEntityRepository::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('create')->with(Telefone::class)->andReturn(true);
        });

        // Act
        $createTelephoneService = new CreateTelephoneService($this->telephoneRepository);

        $result = $createTelephoneService->createTelephone($this->request);

        // Assert
        $this->assertTrue($result);
    }
}
