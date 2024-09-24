<?php

namespace Tests\Unit\Services\Telephone;

use App\Data\Repositories\Telephone\Interfaces\IUpdateTelephoneRepository;
use App\Domains\Services\Telephone\Concretes\UpdateTelephoneService;
use App\Http\Requests\Telephone\UpdateTelephoneRequest;
use Mockery\MockInterface;
use Tests\TestCase;

class UpdateTelephoneServiceTest extends TestCase
{
    private UpdateTelephoneRequest $request;
    private IUpdateTelephoneRepository $updateTelephoneRepository;
    private array $data = [];

    protected function setUp(): void
    {
        parent::setUp();
        $this->data = $this->setDataPhone();
    }

    public function test_success_edit_telephone_with_params_user_id_service(): void
    {
        // Arrange
        $this->request = new UpdateTelephoneRequest();
        $this->request['id'] = $this->data[0]['id'];
        $this->request['ddd'] = $this->data[0]['ddd'];
        $this->request['numero'] = $this->data[0]['numero'];
        $this->request['tipo'] = $this->data[0]['tipo'];
        $this->request['usuarioId'] = $this->data[0]['usuarioId'];
        $this->request['ativo'] = $this->data[0]['ativo'];

        $this->updateTelephoneRepository = $this->mock(IUpdateTelephoneRepository::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('update')
                     ->with($this->request)
                     ->andReturn(true);
        });

        // Act
        $updateTelephoneService = new UpdateTelephoneService($this->updateTelephoneRepository);
        $result = $updateTelephoneService->update($this->request);

        // Assert
        $this->assertTrue($result);
        $this->assertEquals($this->request['id'], $this->data[0]['id']);
        $this->assertEquals($this->request['ddd'],  $this->data[0]['ddd']);
        $this->assertEquals($this->request['numero'], $this->data[0]['numero']);
        $this->assertEquals($this->request['tipo'], $this->data[0]['tipo']);
        $this->assertEquals($this->request['usuarioId'], $this->data[0]['usuarioId']);
        $this->assertEquals($this->request['ativo'], $this->data[0]['ativo']);
    }

    public function test_success_edit_telephone_with_params_provider_id_service(): void
    {
        // Arrange
        $this->request = new UpdateTelephoneRequest();
        $this->request['id'] = $this->data[0]['id'];
        $this->request['ddd'] = $this->data[0]['ddd'];
        $this->request['numero'] = $this->data[0]['numero'];
        $this->request['tipo'] = $this->data[0]['tipo'];
        $this->request['fornecedorId'] = $this->data[0]['fornecedorId'];
        $this->request['ativo'] = $this->data[0]['ativo'];

        $this->updateTelephoneRepository = $this->mock(IUpdateTelephoneRepository::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('update')
                     ->with($this->request)
                     ->andReturn(true);
        });

        // Act
        $updateTelephoneService = new UpdateTelephoneService($this->updateTelephoneRepository);
        $result = $updateTelephoneService->update($this->request);

        // Assert
        $this->assertTrue($result);
        $this->assertEquals($this->request['id'], $this->data[0]['id']);
        $this->assertEquals($this->request['ddd'],  $this->data[0]['ddd']);
        $this->assertEquals($this->request['numero'], $this->data[0]['numero']);
        $this->assertEquals($this->request['tipo'], $this->data[0]['tipo']);
        $this->assertEquals($this->request['fornecedorId'], $this->data[0]['fornecedorId']);
        $this->assertEquals($this->request['ativo'], $this->data[0]['ativo']);
    }
}
