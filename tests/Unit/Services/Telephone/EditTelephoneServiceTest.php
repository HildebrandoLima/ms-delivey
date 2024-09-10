<?php

namespace Tests\Unit\Services\Telephone;

use App\Data\Repositories\Abstracts\IEntityRepository;
use App\Domains\Services\Telephone\Concretes\EditTelephoneService;
use App\Http\Requests\Telephone\EditTelephoneRequest;
use App\Models\Telefone;
use Mockery\MockInterface;
use Tests\TestCase;

class EditTelephoneServiceTest extends TestCase
{
    private EditTelephoneRequest $request;
    private IEntityRepository $telephoneRepository;
    private array $data;

    protected function setUp(): void
    {
        parent::setUp();
        $this->data = $this->setDataPhone();
    }

    public function test_success_edit_telephone_with_params_user_id_service(): void
    {
        // Arrange
        $this->request = new EditTelephoneRequest();
        $this->request['id'] = $this->data[0]['id'];
        $this->request['ddd'] = $this->data[0]['ddd'];
        $this->request['numero'] = $this->data[0]['numero'];
        $this->request['tipo'] = $this->data[0]['tipo'];
        $this->request['usuarioId'] = $this->data[0]['usuarioId'];
        $this->request['ativo'] = $this->data[0]['ativo'];

        $this->telephoneRepository = $this->mock(IEntityRepository::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('update')->with(Telefone::class)->andReturn(true);
        });

        // Act
        $editTelephoneService = new EditTelephoneService($this->telephoneRepository);
        $result = $editTelephoneService->editTelephone($this->request);
        $mappedTelephone = $editTelephoneService->map($this->request);

        // Assert
        $this->assertTrue($result);
        $this->assertInstanceOf(Telefone::class, $mappedTelephone);
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
        $this->request = new EditTelephoneRequest();
        $this->request['id'] = $this->data[0]['id'];
        $this->request['ddd'] = $this->data[0]['ddd'];
        $this->request['numero'] = $this->data[0]['numero'];
        $this->request['tipo'] = $this->data[0]['tipo'];
        $this->request['fornecedorId'] = $this->data[0]['fornecedorId'];
        $this->request['ativo'] = $this->data[0]['ativo'];

        $this->telephoneRepository = $this->mock(IEntityRepository::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('update')->with(Telefone::class)->andReturn(true);
        });

        // Act
        $editTelephoneService = new EditTelephoneService($this->telephoneRepository);
        $result = $editTelephoneService->editTelephone($this->request);
        $mappedTelephone = $editTelephoneService->map($this->request);

        // Assert
        $this->assertTrue($result);
        $this->assertInstanceOf(Telefone::class, $mappedTelephone);
        $this->assertEquals($this->request['id'], $this->data[0]['id']);
        $this->assertEquals($this->request['ddd'],  $this->data[0]['ddd']);
        $this->assertEquals($this->request['numero'], $this->data[0]['numero']);
        $this->assertEquals($this->request['tipo'], $this->data[0]['tipo']);
        $this->assertEquals($this->request['fornecedorId'], $this->data[0]['fornecedorId']);
        $this->assertEquals($this->request['ativo'], $this->data[0]['ativo']);
    }
}
