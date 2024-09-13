<?php

namespace Tests\Unit\Services\Telephone;

use App\Data\Repositories\Abstracts\IEntityRepository;
use App\Domains\Services\Telephone\Concretes\CreateTelephoneService;
use App\Http\Requests\Telephone\CreateTelephoneRequest;
use App\Models\Telefone;
use Mockery\MockInterface;
use Tests\TestCase;

class CreateTelephoneServiceTest extends TestCase
{
    private CreateTelephoneRequest $request;
    private IEntityRepository $telephoneRepository;
    private array $data;

    protected function setUp(): void
    {
        parent::setUp();
        $this->data = $this->setDataPhone();
    }

    public function test_success_create_telephone_with_params_user_id_service(): void
    {
        // Arrange
        $this->request = new CreateTelephoneRequest($this->data);

        $this->telephoneRepository = $this->mock(IEntityRepository::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('create')->with(Telefone::class)->andReturn(true);
        });

        // Act
        $createTelephoneService = new CreateTelephoneService($this->telephoneRepository);
        $result = $createTelephoneService->createTelephone($this->request);
        $mappedTelephone = $createTelephoneService->map($this->request[0]);

        // Assert
        $this->assertTrue($result);
        $this->assertInstanceOf(Telefone::class, $mappedTelephone);
        $this->assertEquals($this->request[0]['ddd'],  $this->data[0]['ddd']);
        $this->assertEquals($this->request[0]['numero'], $this->data[0]['numero']);
        $this->assertEquals($this->request[0]['tipo'], $this->data[0]['tipo']);
        $this->assertEquals($this->request[0]['usuarioId'], $this->data[0]['usuarioId']);
    }

    public function test_success_create_telephone_with_params_provider_id_service(): void
    {
        // Arrange
        $this->request = new CreateTelephoneRequest($this->data);

        $this->telephoneRepository = $this->mock(IEntityRepository::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('create')->with(Telefone::class)->andReturn(true);
        });

        // Act
        $createTelephoneService = new CreateTelephoneService($this->telephoneRepository);
        $result = $createTelephoneService->createTelephone($this->request);
        $mappedTelephone = $createTelephoneService->map($this->request[0]);

        // Assert
        $this->assertTrue($result);
        $this->assertInstanceOf(Telefone::class, $mappedTelephone);
        $this->assertEquals($this->request[0]['ddd'], $this->data[0]['ddd']);
        $this->assertEquals($this->request[0]['numero'], $this->data[0]['numero']);
        $this->assertEquals($this->request[0]['tipo'], $this->data[0]['tipo']);
        $this->assertEquals($this->request[0]['fornecedorId'], $this->data[0]['fornecedorId']);
    }
}
